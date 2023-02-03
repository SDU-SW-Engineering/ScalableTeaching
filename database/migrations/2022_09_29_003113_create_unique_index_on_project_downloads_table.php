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
        Schema::table('project_downloads', function (Blueprint $table) {
            $table->unique(['project_id', 'ref']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_downloads', function (Blueprint $table) {
            $table->dropForeign('project_downloads_project_id_foreign');
            $table->dropUnique('project_downloads_project_id_ref_unique');
        });
    }
};
