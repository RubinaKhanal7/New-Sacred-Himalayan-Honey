<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WhyusSeeder extends Seeder
{
    public function run()
    {
        DB::table('whyuses')->insert([
            [
                'title' => 'Quality and Purity',
                'slug' => 'quality-and-Purity',
                'subtitle' => 'Harvested from Pristine Himalayan Regions',
                'image' => 'image/whyus/bee.png',
                'description' => 'Our mad honey is 100% pure, free from additives or chemicals, capturing the authentic essence of the Himalayas.',
                'content' => 'Our mad honey is 100% pure, free from additives or chemicals, capturing the authentic essence of the Himalayas.'
            ],

            [
                'title' => 'Packaging',
                'slug' => 'packaging',
                'subtitle' => 'Packed with Essential Vitamins and Minerals',
                'image' => 'image/whyus/2.png',
                'description' => 'Our honey is thoughtfully packaged to preserve its purity and flavor. Each jar is carefully sealed to maintain freshness, ensuring you receive the highest quality product with every purchase.',
                'content' => 'Our honey is thoughtfully packaged to preserve its purity and flavor. Each jar is carefully sealed to maintain freshness, ensuring you receive the highest quality product with every purchase.'
            ],

            [
                'title' => 'Availability',
                'slug' => 'availability',
                'subtitle' => 'Experience Himalayan Authenticity Delivered Right to Your Doorstep',
                'image' => 'image/whyus/3.png',
                'description' => 'Available worldwide, we deliver straight to your doorstep from Kathmandu using trusted shipping services. Enjoy the authentic taste of the Himalayas with the convenience of online ordering.',
                'content' => 'Available worldwide, we deliver straight to your doorstep from Kathmandu using trusted shipping services. Enjoy the authentic taste of the Himalayas with the convenience of online ordering.'
            ],

            [
                'title' => 'Expert Craftsmanship',
                'slug' => 'expert-craftsmanship',
                'subtitle' => 'Crafted with Tradition: Sustainably Extracted Honey Preserving Natural Flavors',
                'image' => 'image/whyus/4.png',
                'description' => 'We use traditional, sustainable methods to extract and process our honey, ensuring it retains its natural flavors and properties.',
                'content' => 'We use traditional, sustainable methods to extract and process our honey, ensuring it retains its natural flavors and properties.'
            ],

            [
                'title' => 'Exceptional Experience',
                'slug' => 'exceptional-experience',
                'subtitle' => 'Savor the Unique Flavor and Benefits of Our Mad Honey',
                'image' => 'image/whyus/5.png',
                'description' => 'Enjoy a unique taste and captivating effects with our mad honey, perfect for adventurous foodies and wellness enthusiasts alike.',
                'content' => 'Enjoy a unique taste and captivating effects with our mad honey, perfect for adventurous foodies and wellness enthusiasts alike.'
            ],
           
            [
                'title' => 'Ethical and Sustainable',
                'slug' => 'ethical-sustainable',
                'subtitle' => 'Supporting Sustainable Beekeeping and Community Well-Being',
                'image' => 'image/whyus/5.png',
                'description' => 'Committed to sustainable beekeeping and community support, our honey promotes bee welfare and ecosystem preservation.',
                'content' => 'Committed to sustainable beekeeping and community support, our honey promotes bee welfare and ecosystem preservation.'
            ],
        ]);
    }
}

