<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'whatsapp_number',
        'default_whatsapp_message',
        'email',
        'instagram',
        'instagram_url',
        'office_address',
        'google_maps_embed',
        'operating_hours',
    ];

    public function getCleanWhatsappAttribute(): string
    {
        // Remove spaces, plus, hyphens for wa.me links
        return preg_replace('/[^0-9]/', '', $this->whatsapp_number);
    }

    public function getWhatsappUrlAttribute(): string
    {
        $cleanNumber = $this->clean_whatsapp;
        $encodedMessage = urlencode($this->default_whatsapp_message ?: 'Halo KUBU MANAGEMENT BALI, saya ingin mendapatkan informasi mengenai layanan Landscape/Housekeeping.');
        return "https://wa.me/{$cleanNumber}?text={$encodedMessage}";
    }
}
