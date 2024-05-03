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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expenseReason');
            $table->longText('expenseDescription');
            $table->string('payedPartnerName');
            $table->string('payedPartnerPhone')->nullable();
            $table->float('amount');
            $table->foreignId('service_id')->nullable()->constrained("services")->cascadeOnUpdate()->nullOnDelete();        
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
