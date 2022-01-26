<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('support_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->longText('map_address')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('linkdin')->nullable();
            $table->string('android')->nullable();
            $table->string('ios')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('logo_image2')->nullable();
            $table->string('favicon_image')->nullable();
            $table->string('header_css')->nullable();
            $table->string('header_script')->nullable();
            $table->string('body_script')->nullable();
            $table->string('sidebar_color')->nullable();
            $table->string('nav_color')->nullable();
            $table->boolean('dark_mode')->default(false);
            $table->boolean('default_layout')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
