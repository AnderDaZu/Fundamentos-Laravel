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
            // Modificar columnas
            $table->mediumText('body')
                ->nullable() // si la columna inicial tubo modificadores, se deben agregar cuando se modifique la columna
                ->change(); // este modificador indica la actualización de un campo de la tabla

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post', function (Blueprint $table) {
            $table->text('body')
                ->nullable()
                ->change();
        });
    }
};
