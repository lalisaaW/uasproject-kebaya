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
        Schema::create('jenis_users', function (Blueprint $table) {       
            $table->increments('ID_JENIS_USER', 30)->primary();
            $table->string('JENIS_USER', 60);
            $table->string('CREATE_BY', 30);
            $table->timestamp('CREATE_DATE')->nullable();
            $table->char('DELETE_MARK', 1)->nullable();
            $table->string('UPDATE_BY', 30)->nullable();
            $table->timestamp('UPDATE_DATE')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_users');
    }
};
