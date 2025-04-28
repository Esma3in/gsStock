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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->foreignId('categorie_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->string('name');
            $table->string('image')->default('https://www.google.com/url?sa=i&url=https%3A%2F%2Fpixabay.com%2Fimages%2Fsearch%2Ffree%2520image%2F&psig=AOvVaw1x8_vwxRvzmnl76-PrdY-Q&ust=1744037201689000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCKig1oHTw4wDFQAAAAAdAAAAABAE');
            $table->text('description')->nullable();
            $table->double('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
