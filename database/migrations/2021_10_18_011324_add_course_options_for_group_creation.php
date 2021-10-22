<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseOptionsForGroupCreation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->enum('max_groups', ['custom', 'same_as_assignments', 'none'])->default('same_as_assignments')->after('name');
            $table->integer('max_groups_amount')->default(1)->nullable()->after('max_groups');
            $table->integer('max_group_size')->default(1)->after('max_groups_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            //
        });
    }
}
