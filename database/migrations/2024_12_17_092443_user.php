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
        Schema::create('users', function (Blueprint $table) {
            $table->id('ID_USER'); // Primary key
            $table->string('name', 60);
            $table->string('username', 60);
            $table->string('password', 60);
            $table->string('email', 60);
            $table->string('wa', 15);
            $table->unsignedInteger('ID_JENIS_USER'); // Foreign key field
            $table->string('STATUS_USER', 30)->nullable();
            $table->timestamps();
        
            // Foreign key constraint
            $table->foreign('ID_JENIS_USER')->references('ID_JENIS_USER')->on('jenis_users')->onDelete('cascade');
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        

    }
};
