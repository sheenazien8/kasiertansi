<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoToUserable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('owners', function (Blueprint $table) {
            // $table->dropColumn('photo');
            $table->longText('photo')->nullable()->after('package');
        });
        Schema::table('employees', function (Blueprint $table) {
            // $table->dropColumn('photo');
            $table->longText('photo')->nullable()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->string('photo')->nullable()->after('package');
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('photo');
            $table->string('photo')->nullable()->after('name');
        });
    }
}
