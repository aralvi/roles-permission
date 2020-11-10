<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyPermissionRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_permission_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agency_role_id')->nullable();
            $table->foreign('agency_role_id')->references('id')->on('agency_roles')->onDelete('cascade');
            $table->unsignedBigInteger('agency_permission_id')->nullable();
            $table->foreign('agency_permission_id')->references('id')->on('agency_permissions')->onDelete('cascade');
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
        Schema::dropIfExists('agency_permission_roles');
    }
}
