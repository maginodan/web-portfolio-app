<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_light')->nullable();
            $table->string('logo_dark')->nullable();
            $table->string('favicon')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('hcaptcha_site_key')->nullable();
            $table->string('hcaptcha_secret_key')->nullable();
            $table->boolean('hcaptcha_enabled')->default(false);
            $table->string('primary_color')->default('#3b82f6');
            $table->boolean('cookie_consent_enabled')->default(true);
            $table->text('cookie_consent_text')->nullable();
            $table->string('cookie_accept_text')->default('Accept all');
            $table->string('cookie_decline_text')->default('Necessary only');
            $table->string('cookie_privacy_text')->default('Privacy Policy');
            $table->string('cookie_privacy_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};