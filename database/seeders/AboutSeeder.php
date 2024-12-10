<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'subtitle' => 'Discover the Story Behind Our Journey and Commitment',
            'image' => '1708111815-Himalayan Honey - Landscape.png',
            'description' => 'The Himalayan Honey Company specializes in producing and selling high-quality honey sourced from the Himalayan region. Known for its pure and organic honey, the company emphasizes sustainable and ethical beekeeping practices.',
            'content' => 'The honey is often prized for its unique flavor and nutritional benefits, derived from the diverse and pristine floral sources in the Himalayas. The Himalayan Honey Company also supports local beekeepers, promoting eco-friendly and traditional methods to ensure the authenticity and quality of their products.
            
             ',


        ]);
        // About::factory()->count(1)->create();
    }
}
