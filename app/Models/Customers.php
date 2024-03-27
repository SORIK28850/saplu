<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'userInformation',
        'phone',
        'address',
        'care',
        'schedule',
        'pills',
        'observations',
        'familyPhone',
        'photo',
    ];
}