<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_text',
        'second_text',
        'first_image',
        'second_image',
        'about_our_mission',
        'about_our_vision',
        'about_services',
    ];
}
