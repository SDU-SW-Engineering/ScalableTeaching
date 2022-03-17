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
        Schema::create('survey_field_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_field_id');
            $table->string('name');
            $table->boolean('allow_input')->default(false);
            $table->timestamps();

            $table->foreign('survey_field_id')->references('id')->on('survey_fields');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_field_items');
    }
};
