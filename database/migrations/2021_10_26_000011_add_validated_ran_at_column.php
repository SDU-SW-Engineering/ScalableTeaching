<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValidatedRanAtColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table)
        {
            $table->dropColumn('verified');
            $table->json('validation_errors')->nullable()->after('repo_name');
            $table->timestamp('validated_at')->nullable()->after('validation_errors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table)
        {
            $table->boolean('verified')->default(false)->after('repo_name');
            $table->dropColumn(['validation_errors', 'validated_at']);
        });
    }
}
