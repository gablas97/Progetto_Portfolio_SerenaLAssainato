<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('insights', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->date('date');
            $table->json('images')->nullable();
            $table->json('categories');
            $table->enum('type', ['news', 'insight', 'interview']);
            $table->string('visit_link')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insights');
    }
};
