<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms', function (Blueprint $table) {
            $table->string('about_background')->nullable()->after('about_video_thumb');
            $table->string('dashboard_favorite_ads_background')->nullable()->after('faq_background');
            $table->string('dashboard_messenger_background')->nullable()->after('faq_background');
            $table->string('blog_background')->nullable()->after('faq_background');
            $table->string('ads_background')->nullable()->after('faq_background');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms', function (Blueprint $table) {
            $table->dropColumn('about_background');
            $table->dropColumn('dashboard_favorite_ads_background');
            $table->dropColumn('dashboard_messenger_background');
            $table->dropColumn('blog_background');
            $table->dropColumn('ads_background');
        });
    }
}
