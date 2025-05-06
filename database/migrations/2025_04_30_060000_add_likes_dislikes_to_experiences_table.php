<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLikesDislikesToExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experiences', function (Blueprint $table) {
            $table->unsignedInteger('likes')->default(0)->after('approved');
            $table->unsignedInteger('dislikes')->default(0)->after('likes');
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
            $table->dropColumn(['likes', 'dislikes']);
        });
    }
}
