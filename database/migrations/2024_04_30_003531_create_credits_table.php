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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->longText('creditDescription');
            $table->string('debtorName');
            $table->string('debtorPhone');
            $table->float('amount');
            $table->foreignId('service_id')->nullable()->constrained("services")->cascadeOnUpdate()->nullOnDelete();        
            $table->foreignId('sale_id')->nullable()->constrained("sales")->cascadeOnUpdate()->nullOnDelete();        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
