<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_colleges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('college_id');
            $table->unsignedBigInteger('faculty_id');
            $table->boolean('is_verified')->default(false);
            $table->text('verification_document')->null();
            $table->timestamps();

            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('college_id')->references('id')->on('colleges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_colleges');
    }
}
