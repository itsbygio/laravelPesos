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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->nullable();
            $table->foreignId('id_categoria')
            ->nullable()
            ->constrained('categorias')
            ->onDelete('set null')
            ->onUpdate('cascade');
            $table->string('titulo')->nullable();
            $table->string('stock')->nullable();
            $table->string('precio')->nullable();
            $table->string('size_image')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
