<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sitesetting extends Model
{
    use HasFactory;
    protected $fillable = ['office_name', 'office_address', 'office_contact', 'office_email', 'whatsapp_number', 'main_logo', 'side_logo', 'company_registered_date', 'facebook_link', 'instagram_link', 'snapchat_link','linkedin_link', 'google_maps_link', 'slogan'];
}
