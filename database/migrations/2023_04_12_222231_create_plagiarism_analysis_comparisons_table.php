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
        Schema::create('plagiarism_analysis_comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plagiarism_analysis_id')->constrained();
            $table->foreignId('project_1_id');
            $table->foreignId('project_2_id');
            $table->decimal('overlap', 11, 3);
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
        Schema::dropIfExists('plagiarism_analysis_comparisons');
    }
};
