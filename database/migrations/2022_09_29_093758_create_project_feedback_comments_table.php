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
        Schema::create('project_feedback_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_feedback_id');
            $table->string('filename');
            $table->integer('line');
            $table->text('comment');
            $table->enum('mark_as', ['helpful', 'not_helpful'])->nullable();
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('draft');
            $table->string('reviewer_feedback')->nullable()->comment('Comments from the person reviewing the comment.');
            $table->unsignedBigInteger('reviewer_id')->nullable();
            $table->timestamps();

            $table->foreign('project_feedback_id')->references('id')->on('project_feedback');
            $table->foreign('reviewer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_feedback_comments');
    }
};
