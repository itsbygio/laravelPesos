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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->foreignId('id_categoria')
            ->nullable()
            ->constrained('categorias')
            ->onDelete('set null')
            ->onUpdate('cascade');
            $table->foreignId('id_producto')
            ->nullable()
            ->constrained('productos')
            ->onDelete('set null')
            ->onUpdate('cascade');
            $table->longText('cant')->nullable();
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
        Schema::dropIfExists('ventas');
    }
};
