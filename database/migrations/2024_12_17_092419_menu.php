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
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('MENU_ID')->primary();
            // $table->string('ID_LEVEL', 30);
            $table->string('MENU_NAME', 300);
            $table->string('MENU_LINK', 300);
            $table->string('MENU_ICON', 300)->nullable();
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
        Schema::dropIfExists('menus');
    }
};
