<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'content_1',
        'content_2',
        'hero_image',
        'vision_title',
        'vision_content',
        'mission_title',
        'mission_content',
        'vision_image',
        'innovation_content',
        'innovation_title',
        'clinic_count',
        'hospital_count',
        'partner_count',

    ];

}
