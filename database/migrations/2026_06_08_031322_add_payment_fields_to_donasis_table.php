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
        Schema::table('donasis', function ($table) {

    $table->integer('fitur_total')->default(0);

    $table->integer('admin_fee')->default(0);

    $table->integer('grand_total')->default(0);

    $table->string('payment_method')->nullable();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donasis', function (Blueprint $table) {
            //
        });
    }
};
