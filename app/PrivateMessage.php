<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \App\Traits\RandomId;
use Illuminate\Http\Request;

class PrivateMessage extends Model
{
    use SoftDeletes;
    use RandomId;

    protected static function boot()
    {
        parent::boot();

        static::created(function (PrivateMessage $message) {
            $message->generateUniqueId();
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