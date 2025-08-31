<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('expected_results')->nullable();
            $table->text('usage_instructions')->nullable();
            $table->string('time_of_use')->nullable();
            $table->string('shelf_life')->nullable();
            $table->text('incompatible_products')->nullable();
            $table->string('image')->nullable();
            $table->string('recommended_for')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
