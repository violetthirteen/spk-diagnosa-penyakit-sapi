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
        Schema::create('solusi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_solusi')->unique();
            $table->text('deskripsi_solusi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solusi');
    }
};
