<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kebayas', function (Blueprint $table) {
            $table->id('ID_KEBAYA');
            $table->string('NAMA_KEBAYA', 100);
            $table->text('DESKRIPSI');
            $table->decimal('HARGA_SEWA', 10, 2);
            $table->string('UKURAN', 10);
            $table->string('WARNA', 50);
            $table->string('FOTO_URL')->nullable();
            $table->unsignedBigInteger('ID_USER');
            $table->foreign('ID_USER')->references('ID_USER')->on('users')->onDelete('cascade');
            $table->string('CREATE_BY', 30);
            $table->timestamp('CREATE_DATE')->useCurrent();
            $table->char('DELETE_MARK', 1)->default('N');
            $table->string('UPDATE_BY', 30)->nullable();
            $table->timestamp('UPDATE_DATE')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kebayas');
    }
};
