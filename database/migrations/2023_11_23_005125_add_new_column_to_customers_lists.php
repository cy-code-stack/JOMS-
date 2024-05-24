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
        Schema::table('customers_lists', function (Blueprint $table) {      
            $table->string('fullAdress')->nullable();;
            $table->string('country')->nullable();;
            $table->string('region')->nullable();;
            $table->string('lat');
            $table->string('lng');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers_lists', function (Blueprint $table) {
            $table->dropColumn('fullAdress')->nullable();;
            $table->dropColumn('country')->nullable();;
            $table->dropColumn('region')->nullable();;
            $table->dropColumn('lat');
            $table->dropColumn('lng');
        });
    }
};
