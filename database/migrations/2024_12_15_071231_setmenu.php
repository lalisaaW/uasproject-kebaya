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
            $table->increments('no_setting');
            $table->unsignedBigInteger('role_id'); 
            $table->unsignedInteger('menu_id');
            $table->string('created_by', 30); 
            $table->timestamps(); 
            $table->softDeletes(); 

            // Foreign key constraints
            $table->foreign('role_id')
                ->references('role_id')
                ->on('roles')
                ->onDelete('cascade');

            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('menus')
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
