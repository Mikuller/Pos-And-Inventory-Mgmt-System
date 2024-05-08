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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->longText('deptDescription');
            $table->string('creditorName');
            $table->string('creditorPhone')->nullable();
            $table->float('amount');
            $table->foreignId('expense_id')->nullable()->constrained("expenses")->cascadeOnUpdate()->nullOnDelete();        
            $table->foreignId('purchase_id')->nullable()->constrained("purchases")->cascadeOnUpdate()->nullOnDelete();        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debts');
    }
};
