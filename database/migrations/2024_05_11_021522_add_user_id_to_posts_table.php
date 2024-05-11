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
            
            // $table->bigInteger('user_id')
            //     ->unsigned();

            // lo de arriba ☝️ es lo mismo de abajo 👇

            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id') // llave foranea -> se agrega restricción
            //     ->references('id')
            //     ->on('users');

            $table->foreignId('user_id') // agrega unsignedBigInteger y foreign
                ->constrained() // agrega las restricciones de ->references() y ->on()
                // ->nullable() // si se agrega onDelete('set null') se debe agregar esta restricción
                // ->onDelete('set null') // si se elimina el usuario que se marque user_id como null
                ->onUpdate('cascade') // si se actualiza el id del usuario que tambien se actualice el user_id
                ->onDelete('cascade'); // si se elimina el usuario que se elimine tambien el post
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
};
