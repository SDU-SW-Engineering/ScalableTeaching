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
        Schema::table('tasks', function (Blueprint $table) {
            $table->dateTimeTz('starts_at')->nullable()->change();
            $table->dateTimeTz('ends_at')->nullable()->change();
            $table->dropColumn('short_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dateTimeTz('starts_at')->change();
            $table->dateTimeTz('ends_at')->change();
            $table->text('short_description')->nullable();
        });
    }
};
