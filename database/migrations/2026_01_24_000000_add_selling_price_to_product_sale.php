<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('product_sale', function (Blueprint $table) {
            if (!Schema::hasColumn('product_sale', 'selling_price')) {
                $table->decimal('selling_price', 15, 2)->nullable()->after('amount');
            }
        });
    }

    public function down()
    {
        Schema::table('product_sale', function (Blueprint $table) {
            if (Schema::hasColumn('product_sale', 'selling_price')) {
                $table->dropColumn('selling_price');
            }
        });
    }
};
