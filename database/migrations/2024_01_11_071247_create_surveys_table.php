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
        Schema::create('surveys', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('content')->nullable();
            $table->tinyInteger('form_type')->nullable()->comment('1:テキストボックス・2:テキストエリア・3:ラジオボタン・4:チェックボックス');
            $table->text('choices')->nullable()->comment('※ラジオボタン・チェックボックスの場合、カンマ区切りで選択肢を登録する');
            $table->integer('sort_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('restaurants_id')->index('fk_surveys_restaurants1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
