<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('register_survey', function (Blueprint $table) {
            $table->string('colour')->nullable();
            $table->foreignId('id_transmission')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('register_survey', function (Blueprint $table) {
            $table->string('colour')->nullable();
            $table->foreignId('id_transmission')->nullable();
        });
    }
};
