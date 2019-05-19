<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToOwnersAndEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('name');
            $table->text('address')->nullable()->after('photo');
            $table->string('end_date')->nullable()->after('join_date');
            $table->boolean('status')->default(false)->after('end_date');
        });
        Schema::table('owners', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('name');
            $table->text('address')->nullable()->after('photo');
        });
        Schema::table('users', function (Blueprint $table)
        {
            $table->string('package')->nullable()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('address');
            $table->dropColumn('end_date');
            $table->dropColumn('status');
        });
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->dropColumn('address');
       });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('package');
       });
    }
}
