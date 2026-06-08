<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {

        $table->text('bio')->nullable();

        $table->string('game')->nullable();

        $table->string('instagram')->nullable();

        $table->string('youtube')->nullable();

        $table->string('tiktok')->nullable();

        $table->string('discord')->nullable();

        $table->integer('followers')->default(0);

        $table->bigInteger('total_donasi')->default(0);

    });
}

    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {

        $table->dropColumn([
            'bio',
            'game',
            'instagram',
            'youtube',
            'tiktok',
            'discord',
            'followers',
            'total_donasi'
        ]);

    });
}
};
