<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTableToReflectGitlabOauth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['guid', 'given_name', 'sur_name', 'title', 'ad_groups']);
            $table->string('username');
            $table->integer('gitlab_id');
            $table->datetime('last_login');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('guid');
            $table->string('given_name')->nullable();
            $table->string('sur_name')->nullable();
            $table->string('title')->nullable();
            $table->json('ad_groups')->nullable();
        });
    }
}
