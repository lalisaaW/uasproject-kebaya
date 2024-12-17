<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('created_by')->default('Unknown')->change();
        });
    }
    
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('created_by')->nullable()->change(); // atau sesuaikan dengan tipe awal kolom
        });
    }
};
