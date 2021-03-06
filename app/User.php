<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamp = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirm_code',
        'activated',
        'gender',
        'phoneNumber',
        'bankName',
        'accountNumber',
        'photo',
        'signature',
        'type',
        'recommender',
        'recommend_code',
        'AclassRecommender',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        'confirm_code',
    ];

    protected $casts = [
        'activated' => 'boolean',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function servicecenter()
    {
        return $this->hasMany(ServiceCenter::class);
    }
}
