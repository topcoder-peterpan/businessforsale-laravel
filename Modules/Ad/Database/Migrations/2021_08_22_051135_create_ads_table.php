<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->foreignId('town_id')->constrained('towns')->onDelete('cascade');
            $table->string('model')->nullable();
            $table->enum('condition', ['used', 'new'])->nullable();
            $table->enum('authenticity', ['original', 'refurbished'])->nullable();
            $table->boolean('negotiable')->default(0);
            $table->float('price');
            $table->longText('description');
            $table->string('phone');
            $table->string('phone_2')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('status', ['active', 'expired'])->default('active');
            $table->boolean('featured')->default(false);
            $table->integer('total_reports')->default(0);
            $table->integer('total_views')->default(0);
            $table->boolean('is_blocked')->default(false);
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
        Schema::dropIfExists('ads');
    }
}
