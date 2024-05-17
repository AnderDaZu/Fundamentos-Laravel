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
        Schema::table('posts', function (Blueprint $table) {
            // $table->dropForeign('posts_user_id_foreign');
            // ☝️ = 👇
            // $table->dropForeign(['user_id']);

            $table->foreignId('category_id')
                ->after('body')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // no se debe usar foreignId y constrained
            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');

            $table->dropForeign(['category_id']);
        });
    }
};
