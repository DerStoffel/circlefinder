<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Traits\NeedsValidation;

class Membership extends Model
{
    use NeedsValidation;
    
    protected $dates = ['begin'];

    protected $fillable = [
        'type',
        'begin',
    ];

    public static function validationRules($except = null)
    {
        $rules = [
            'type' => 'required|in:' . implode(',', config('circle.defaults.types')),
            'begin' => 'required|date',
        ];

        if ($except) {
            $rules = array_except($rules, $except);
        }

        return $rules;
    }

    public function __toString()
    {
        return sprintf('Membership in %s', $this->circle);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($membership) {
            $membership->timeSlot()->create();
        });

        static::deleting(function ($membership) {
            $membership->languages()->detach();
            $membership->timeSlot()->delete();
        });
    }

    public function languages()
    {
        return $this->belongsToMany(\App\Language::class);
    }

    public function circle()
    {
        return $this->belongsTo(\App\Circle::class);
    }

    public function ownedBy($user)
    {
        return $this->user->id == $user->id;
    }

    public function timeSlot()
    {
        return $this->hasOne(\App\TimeSlot::class);
    }

    public function updateAndModify($request)
    {
        $this->update($request->all());

        if ($request->languages) {
            $languages = \App\Language::whereIn('code', array_values($request->languages))->get();
            $this->languages()->sync($languages);
        } else {
            $this->languages()->detach();
        }
    }
}
