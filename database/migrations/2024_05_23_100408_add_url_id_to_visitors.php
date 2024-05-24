<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->foreignId('url_id')->nullable()->after('id')->constrained('urls');
        });
    }

    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropForeign(['url_id']);
            $table->dropColumn('url_id');
        });
    }
};  
