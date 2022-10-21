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
        Schema::table('register_claim', function($table) {
            $table->dropColumn('id_register_claim');
            $table->string('register_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('register_claim', function($table) {
            $table->dropColumn('id_register_claim');
            $table->string('register_number')->nullable();
        });
    }
};
