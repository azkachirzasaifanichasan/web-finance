<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->string('month', 20);
            $table->decimal('amount', 12, 2)->unsigned()->default(0);
            $table->timestamps();

            $table->unique(['student_id', 'month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_payments');
    }
};
