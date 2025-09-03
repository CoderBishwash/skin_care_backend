<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('skin_types', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Dry Skin, Oily Skin, etc.
            $table->text('description'); // Detailed description
            $table->string('image')->nullable(); // image file path
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('skin_types');
    }
};
