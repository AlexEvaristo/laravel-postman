<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\AuthTrait;


class Unity extends Model
{
    protected $fillable = [
        'name'
    ];

    public function unity()
    {
        return $this->hasMany(Products::class);
    }
}
