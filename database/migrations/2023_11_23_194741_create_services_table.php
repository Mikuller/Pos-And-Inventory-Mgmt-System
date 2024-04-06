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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('customerName');
            $table->string('customerPhone');
            $table->float('price');
            $table->string('status');
            $table->longText('statusNote')->nullable();
            $table->string('refNumber')->unique();
            $table->string('paymentMethod')->nullable();
            $table->foreignId('deposit_bank_id')->nullable()->constrained("deposit_banks")->cascadeOnUpdate()->nullOnDelete();
            $table->string('eCashRefNumber')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
