<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('donasis', function ($table) {

        $table->string('invoice_id')->nullable();

        $table->longText('qris_content')->nullable();

        $table->string('qris_status')
              ->default('pending');

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
