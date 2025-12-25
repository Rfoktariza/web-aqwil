<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebpageSetting extends Model
{
    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'whatsapp_number',
        'footer_email',
        'footer_phone',
        'company_address',
        'link_facebook',
        'link_twitter',
        'link_linkedin',
        'footer_text',
        'catalog_pdf',
        'maps_embed',
    ];

    // Ambil record tunggal
    public static function firstOrDefault()
    {
        return static::first() ?? new static();
    }
}
