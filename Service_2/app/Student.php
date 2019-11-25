<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'password','adress','email','level','birth_place','birth_day'
    ];
    protected $hidden = [
        'password', 'remember_token','updated_at','created_at'
    ];

}
