<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->date('expense_date')->useCurrent();
            $table->string('item', 100);
            $table->decimal('unit_price', 12, 2)->unsigned()->default(0.00);
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->decimal('total_price', 12, 2)->unsigned()->storedAs('unit_price * quantity');
            $table->string('description', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};