<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Traits\RandomId;

class PrivateMessage extends Model
{
    use SoftDeletes;
    use RandomId;

    protected static function boot()
    {
        parent::boot();

        static::created(function (User $user) {
            $user->generateUniqueId();
        });
    }

    protected $dates = [
        'read_at'
    ];

    protected $fillable = [
        'body'
    ];

    public function recipient()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function validationRules($except = null)
    {
        $rules = [
            'body' => 'required'
        ];

        if ($except) {
            $rules = array_except($rules, $except);
        }

        return $rules;
    }
}
