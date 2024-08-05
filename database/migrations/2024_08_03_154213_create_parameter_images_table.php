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
        Schema::create('parameter_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parameter_id')->constrained('parameters')->onDelete('cascade');
            $table->string('type'); //icon or icon_gray
            $table->string('original_name');
            $table->string('unique_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_images');
    }
};
