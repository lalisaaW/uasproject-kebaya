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
        Schema::create('setting_menus', function (Blueprint $table) {
            $table->increments('no_setting');  // Menyesuaikan penamaan dengan snake_case
            $table->unsignedInteger('menu_id');  // Menyesuaikan dengan tipe data yang sama dengan kolom menu_id pada tabel menus
            $table->unsignedBigInteger('role_id');  // Menyesuaikan dengan tipe data yang sama dengan kolom role_id pada tabel roles
            $table->string('create_by', 30);  // Menyesuaikan dengan snake_case
            $table->timestamp('create_date')->nullable();  // Menyesuaikan dengan snake_case
            $table->char('delete_mark', 1)->nullable();  // Menyesuaikan dengan snake_case
            $table->string('update_by', 30)->nullable();  // Menyesuaikan dengan snake_case
            $table->timestamp('update_date')->nullable();  // Menyesuaikan dengan snake_case
        
            // Foreign key constraints
            $table->foreign('menu_id')
                  ->references('menu_id')
                  ->on('menus')
                  ->onDelete('cascade');
        
            $table->foreign('role_id')
                  ->references('role_id')
                  ->on('roles')
                  ->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_menus');
    }
};
