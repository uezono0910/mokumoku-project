<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('survey-answer', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('answer')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('surveys_id')->index('fk_survey_answer_surveys1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('survey-answer');
    }
};
