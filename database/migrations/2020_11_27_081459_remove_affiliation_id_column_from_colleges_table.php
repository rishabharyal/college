<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAffiliationIdColumnFromCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('colleges', function (Blueprint $table) {
            $table->dropForeign('colleges_affiliation_id_foreign');
            $table->dropColumn('affiliation_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('colleges', function (Blueprint $table) {
            $table->unsignedBigInteger('affiliation_id');
            $table->foreign('affiliation_id')->references('id')->on('affiliations');
        });
    }
}
