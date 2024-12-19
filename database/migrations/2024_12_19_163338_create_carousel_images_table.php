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
        Schema::create('carousel_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true); // To allow deactivation
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carousel_images');
    }

};
