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
        Schema::create('data', function (Blueprint $table) {

            // https://laravel.com/docs/10.x/migrations#available-column-types

            $table->id();
            $table->bigIncrements('id_2'); // permite crear llaves de id grandes
            $table->uuid('id');	// Tipo de columna equivalente a UUID.

            $table->integer('user_id'); // permite almacenar datos desde -2147483648 hasta 2147483647
            $table->bigInteger('car_id'); // permite almacenar datos más grandes que integer

            $table->boolean('is_active'); // crea un campo de tipo tynint el cual recibe el valor de 0 como false y 1 como true

            $table->dateTime('created_at'); // permite almacenar datos de tipo fecha y hora
            $table->date('date_created'); // permite almacenar datos de tipo fecha
            $table->time('hour'); // permite alamacenar datos de tipo hora
            $table->timestamp('created_at');

            $table->decimal('amount', 8, 2); // permite almacenar datos de tipo decimal, donde se especifica la precisión y cant de decimales (2)
            $table->double('total');
            $table->float('roas');

            $table->enum('source', ['web', 'mobil']); // permite almacenar datos que se definen en un conjunto de datos

            $table->foreignId('category_id'); // permite crear relación con otra tabla, crea un entero grande sin signo
            // ------------- lo de arriba es equivalente a lo de abajo ---------------
            $table->bigInteger('color_id')
                ->unsigned();

            // relaciones polimorficas
            $table->morphs('taggable'); // 	Agrega los tipos de columna equivalente a UNSIGNED BIGINT taggable_id y VARCHAR taggable_type.
            // ------------- lo de arriba es equivalente a lo de abajo ----------------
            $table->bigInteger('taggable_id')->unsigned();
            $table->string('taggable_type');

            $table->uuidMorphs('taggable'); // Agrega las columnas UUID equivalentes taggable_id CHAR(36) y taggable_type VARCHAR(255).
            

            $table->json('data'); // para guardar arrays

            $table->string('name'); // permite guardar cadenas de texto de hasta 255 caracteres
            $table->text('description'); //permite guardar cadenas de texto de hasta 65.535 caracteres
            $table->mediumText('body'); // permite guardar cadenas de texto de hasta 16.777.215 caracteres
            $table->longText('layout'); // permite guardar cadenas de texto de hasta 4.294.967.295 caracteres

            $table->softDeletes(0); // Agrega un tipo de columna equivalente a TIMESTAMP que permita nulos para deleted_at en eliminaciones lógicas con precisión (dígitos totales).

            $table->timestamps();

            // Modificadores de columnas
            $table->string('lastname')
                ->default('Andershopy'); // valor por defecto 
            $table->text('description')
                ->nullable(); // si no recibe algún valor, se agregará null como valor, quiere decir que el campo es opcional
            $table->integer('edad')
                ->unsigned(); // permite ingresar solo valores positivos
            $table->timestamp('published_at')
                ->useCurrent(); // permite usar la fecha y hora actual como valor por defecto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
