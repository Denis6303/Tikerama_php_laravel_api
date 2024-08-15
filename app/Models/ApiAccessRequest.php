<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiAccessRequest extends Model
{
    use HasFactory;

    // Specify the fillable attributes if using mass assignment
    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'email',
        'city',
        'address',
    ];
}

