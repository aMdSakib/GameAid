<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTypeFromExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->string('type')->default('experience')->after('content');
        });
    }
}
