<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SitesettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sitesettings')->insert([
            'office_name' => 'Himalayan Honey',
            'office_address' => json_encode(['Kathmandu, Nepal']), 
            'office_contact' => json_encode(['9779851071223', '+971 56 834 8311']),
            'office_email' => json_encode(['test@gmail.com', 'default@gmail.com']),
            'whatsapp_number' => '9779851071204',
            'main_logo' => 'uploads/sitesetting/main_logo.png',
            'side_logo' => 'uploads/sitesetting/side_logo.png',
            'company_registered_date' => '2020-01-02',
            'facebook_link' => 'https://www.facebook.com/himalayanhoney',
            'instagram_link' => 'https://www.instagram.com/himalayanhoney/',
            'snapchat_link' => 'https://www.snapchat.com/himalayanhoney/',
            'linkedin_link' => 'https://www.linkedin.com/in/himalayanhoney/',
            'google_maps_link' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.5838728332933!2d85.3486855148711!3d27.699253482795278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1bdfeb28a41f%3A0xf0e4c10a1694fa53!2sAasha%20Tech!5e0!3m2!1sen!2snp!4v1674808462785!5m2!1sen!2snp',
            'slogan' => "Sweet Deals, Straight from the Hive!",
        ]);
    }
}