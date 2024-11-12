<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Support\Facades\Hash;

class User extends Model

{

    protected $fillable = [

        'name',

        'email',

        'password',

    ];


    protected $hidden = [

        'password',

        'remember_token',

    ];


    public function setPasswordAttribute($value)

    {

        $this->attributes['password'] = Hash::make($value); // This should work now

    }

}