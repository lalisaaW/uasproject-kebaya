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
            $table->increments('menu_id'); // Primary key dengan snake_case
            $table->string('menu_name', 300); // Nama menu
            $table->string('menu_link', 300); // Link menu
            $table->string('menu_icon', 300)->nullable(); // Icon menu (opsional)
            $table->string('created_by', 30); // User yang membuat
            $table->timestamps(); // created_at & updated_at otomatis
            $table->softDeletes(); // deleted_at untuk soft delete
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
