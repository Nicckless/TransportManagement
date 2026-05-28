<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Worker extends Authenticatable
{
    use HasApiTokens,Notifiable,HasFactory;

    protected $fillable = [
        'name',
        'password',
        'role'
    ];

    protected $hidden = [
        'password'
    ];
}
