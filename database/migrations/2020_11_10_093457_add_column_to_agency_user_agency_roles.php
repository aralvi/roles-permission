<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToAgencyUserAgencyRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agency_user_agency_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('agency_user_agency_id')->nullable();
            $table->foreign('agency_user_agency_id')->references('id')->on('agency_user_agencies')->onDelete('cascade');
            $table->unsignedBigInteger('agency_role_id')->nullable();
            $table->foreign('agency_role_id')->references('id')->on('agency_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agency_user_agency_roles', function (Blueprint $table) {
            //
        });
    }
}
