<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('google')->default(true);
            $table->boolean('facebook')->default(true);
            $table->boolean('twitter')->default(true);
            $table->boolean('linkedin')->default(true);
            $table->boolean('github')->default(true);
            $table->boolean('gitlab')->default(true);
            $table->boolean('bitbucket')->default(true);
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
        Schema::dropIfExists('social_settings');
    }
}
