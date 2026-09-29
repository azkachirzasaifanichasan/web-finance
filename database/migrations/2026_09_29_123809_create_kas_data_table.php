<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas_data', function (Blueprint $table) {
            $table->id();
            $table->char('nis', 5)->unique();
            $table->unsignedTinyInteger('absent_number')->nullable();
            $table->string('full_name', 100)->notnull();
            $table->decimal('example_month', 12, 2)->unsigned()->default(0.00);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_data');
    }
};