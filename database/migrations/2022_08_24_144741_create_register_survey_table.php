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
        Schema::create('register_survey', function (Blueprint $table) {
            $table->id('id_register_survey');
            $table->string('register_no');
            $table->foreignId('id_customer')
            ->constrained()
            ->references('id_customer')
            ->on('customer')
            ->onUpdate('cascade')
            ->onDelete('no action');
            $table->foreignId('id_vehicle')
            ->constrained()
            ->references('id_vehicle')
            ->on('vehicle')
            ->onUpdate('cascade')
            ->onDelete('no action');
            $table->string('register_date');
            $table->foreignId('id_user')
            ->constrained()
            ->references('id_user')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('no action');
            $table->string('survey_date');
            $table->string('link_zoom');
            $table->string('status');
            $table->foreignId('id_branch')
            ->constrained()
            ->references('id_branch')
            ->on('branch')
            ->onUpdate('cascade')
            ->onDelete('no action');
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
        Schema::dropIfExists('register_survey');
    }
};
