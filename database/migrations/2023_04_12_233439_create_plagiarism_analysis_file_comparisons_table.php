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
        Schema::create('plagiarism_analysis_file_comparisons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plagiarism_analysis_id')->constrained()->index('fk_plag_analisys_file_overlap');
            $table->foreignId('project_1_id');
            $table->foreignId('project_2_id');
            $table->string('filename_1');
            $table->string('filename_2');
            $table->decimal('overlap', 11, 3);
            $table->json('meta')->nullable();
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
        Schema::dropIfExists('plagiarism_analysis_file_comparisons');
    }
};
