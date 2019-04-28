<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfitColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->double('profit')->nullable()->after('price');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->double('total_profit')->nullable()->after('total_price');
        });
        Schema::table('incomes', function (Blueprint $table) {
            $table->double('total_profit')->nullable()->after('total_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropColumn('profit');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('total_profit');
        });
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropColumn('total_profit');
        });
    }
}
