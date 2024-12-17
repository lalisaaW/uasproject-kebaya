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
            $table->increments('NO_SETTING')->primary();
            $table->unsignedInteger('ID_JENIS_USER');
            $table->unsignedInteger('MENU_ID'); 
            $table->string('CREATE_BY', 30);
            $table->timestamp('CREATE_DATE')->nullable();
            $table->char('DELETE_MARK', 1)->nullable();
            $table->string('UPDATE_BY', 30)->nullable();
            $table->timestamp('UPDATE_DATE')->nullable();

            $table->foreign('ID_JENIS_USER')->references('ID_JENIS_USER')->on('jenis_users')->onDelete('cascade');
            $table->foreign('MENU_ID')->references('MENU_ID')->on('menus')->onDelete('cascade');
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
