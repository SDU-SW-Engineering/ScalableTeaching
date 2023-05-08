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
        Schema::create('plagiarism_analyses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained();
            $table->string('method');
            $table->dateTime('analyzed_at');
            $table->enum('average_calculation', ['file_average', 'overall_average'])->comment('When a complete plagiarism overlap is calculated should either file_aver be used or the overall provided.')
                ->default('overall_average');
            $table->longText('output')->nullable();
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
        Schema::dropIfExists('plagiarism_analyses');
    }
};
