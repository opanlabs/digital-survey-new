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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('name');
            $table->string('phone_number');
            $table->string('photo_url')
                    ->nullable();
            $table->foreignId('id_branch')
                    ->constrained()
                    ->references('id_branch')
                    ->on('branch')
                    ->onUpdate('cascade')
                    ->onDelete('no action');
            $table->foreignId('id_role')
                    ->default(1)
                    ->constrained()
                    ->references('id_role')
                    ->on('roles')
                    ->onUpdate('cascade')
                    ->onDelete('no action');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
