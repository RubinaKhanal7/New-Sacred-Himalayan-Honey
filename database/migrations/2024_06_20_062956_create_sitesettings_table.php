<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sitesettings', function (Blueprint $table) {
            $table->id();
            $table->string('office_name');
            $table->text('office_address');
            $table->string('office_contact');
            $table->string('office_email');
            $table->string('whatsapp_number');
            $table->string('main_logo');
            $table->string('side_logo')->nullable();
            $table->date('company_registered_date');
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('snapchat_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->text('google_maps_link')->nullable();
            $table->string('slogan')->nullable(); // Added slogan field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sitesettings');
    }
};
