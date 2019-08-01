<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusColumnToSubsidiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subsidiaries', function (Blueprint $table) {
            $table->boolean('status')->default(false)->after('address');
            $table->date('closed_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subsidiaries', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('closed_at');
        });
    }
}
