<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('posting_rules')->nullable()->after('body_script');
            $table->text('about')->nullable()->after('body_script');
            $table->text('terms')->nullable()->after('body_script');
            $table->text('privacy')->nullable()->after('body_script');
            $table->integer('free_ad_limit')->default(5)->after('body_script');
            $table->integer('free_featured_ad_limit')->default(3)->after('body_script');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('posting_rules');
            $table->dropColumn('about');
            $table->dropColumn('privacy');
            $table->dropColumn('terms');
            $table->dropColumn('free_ad_limit');
            $table->dropColumn('free_featured_ad_limit');
        });
    }
}
