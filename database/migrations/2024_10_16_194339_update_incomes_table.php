<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->decimal('amount_pesos', 15, 2)->after('amount');
            $table->decimal('amount_dollars', 15, 2)->after('amount_pesos');
        });
    }

    public function down()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropColumn(['amount_pesos', 'amount_dollars']);
        });
    }
};