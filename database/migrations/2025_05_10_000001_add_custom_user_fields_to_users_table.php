<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('owner_type')->nullable();
            $table->string('identifier')->nullable();
            $table->string('grade_level')->nullable();
            $table->string('homeroom')->nullable();
            $table->date('dob')->nullable();
            $table->string('building')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'owner_type',
                'identifier',
                'grade_level',
                'homeroom',
                'dob',
                'building'
            ]);
        });
    }
};
