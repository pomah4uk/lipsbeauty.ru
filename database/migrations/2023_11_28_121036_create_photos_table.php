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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('name_photo'); // имя файла для вывода
            $table->string('original_name'); // оригинальное имя файла
            $table->string('path'); // путь к файлу
            $table->text('description')->nullable(); // описание
            $table->unsignedBigInteger('uploaded_by')->nullable(); // id пользователя
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
