<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id('ID_RENTAL');
            $table->unsignedBigInteger('ID_KEBAYA');
            $table->unsignedBigInteger('ID_USER');
            $table->date('TANGGAL_MULAI');
            $table->date('TANGGAL_SELESAI');
            $table->decimal('TOTAL_HARGA', 10, 2);
            $table->enum('STATUS', ['pending', 'active', 'completed', 'cancelled'])->default('pending');
            $table->string('CREATE_BY', 30);
            $table->timestamp('CREATE_DATE')->useCurrent();
            $table->char('DELETE_MARK', 1)->default('N');
            $table->string('UPDATE_BY', 30)->nullable();
            $table->timestamp('UPDATE_DATE')->nullable();

            $table->foreign('ID_KEBAYA')->references('ID_KEBAYA')->on('kebayas')->onDelete('cascade');
            $table->foreign('ID_USER')->references('ID_USER')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rentals');
    }
};
