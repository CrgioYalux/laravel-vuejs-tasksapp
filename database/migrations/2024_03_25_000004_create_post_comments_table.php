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
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_post_id');
            $table->unsignedBigInteger('to_post_id');
            $table->timestamps();

            $table->foreign('from_post_id')
                  ->references('id')
                  ->on('posts')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreign('to_post_id')
                  ->references('id')
                  ->on('posts')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_comments');
    }
};
