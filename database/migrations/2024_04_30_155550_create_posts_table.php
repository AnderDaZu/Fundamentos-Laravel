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
        Schema::create('posts', function (Blueprint $table) {
            // $table->id();
            
            // $table->bigInteger('id')
            //     ->autoIncrement() // agrega llave primaria y valores auto incrementales
            //     ->unsigned(); // evitar que se agreguen valores negativos
            // lo de arriba ☝️ es igual que lo de abajo 👇
            $table->bigIncrements('id');

            // Si no se requiere valores tan grandes en la tabla primaria, se puede declarar de la siguiente manera:
            // $table->increments('id');

            $table->index('title');
            $table->fullText('body');

            $table->string('title');
            // $table->string('slug');
            $table->text('body')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
