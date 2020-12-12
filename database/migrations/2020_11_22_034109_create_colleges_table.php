<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('affiliation_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('faculty_id');
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->decimal('minimim_acceptance_percentage')->nullable();
            $table->decimal('minimum_scholarship_percentage')->nullable();
            $table->timestamps();

            $table->foreign('affiliation_id')->references('id')->on('affiliations');
            $table->foreign('level_id')->references('id')->on('levels');
            $table->foreign('faculty_id')->references('id')->on('faculties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colleges');
    }
}
