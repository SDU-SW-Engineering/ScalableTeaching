<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_role_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_role_id');
            $table->unsignedSmallInteger('permission_level')->default(0);

            $table->foreign('course_role_id')->references('id')->on('course_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_role_permissions');
    }
};
