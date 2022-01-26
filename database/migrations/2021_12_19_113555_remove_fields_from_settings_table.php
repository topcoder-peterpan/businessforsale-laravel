<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFieldsFromSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('privacy');
            $table->dropColumn('terms');
            $table->dropColumn('about');
            $table->dropColumn('posting_rules');
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
            $table->text('posting_rules')->nullable()->after('body_script');
            $table->text('about')->nullable()->after('body_script');
            $table->text('terms')->nullable()->after('body_script');
            $table->text('privacy')->nullable()->after('body_script');
        });
    }
}
