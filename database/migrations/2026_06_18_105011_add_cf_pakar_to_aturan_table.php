<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aturan', function (Blueprint $table) {

            $table->double('cf_pakar')->default(0.8);

        });
    }

    public function down(): void
    {
        Schema::table('aturan', function (Blueprint $table) {

            $table->dropColumn('cf_pakar');

        });
    }
};
