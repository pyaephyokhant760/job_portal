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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->integer('job_type_id');
            $table->integer('vacancy');
            $table->string('salary')->nullable();
            $table->string('location');
            $table->longText('description')->nullable();
            $table->longText('benefits')->nullable();
            $table->longText('responsibility')->nullable();
            $table->longText('qualifications')->nullable();
            $table->longText('keywords')->nullable();
            $table->string('experience');
            $table->string('company_name');
            $table->string('company_location')->nullable();
            $table->string('company_website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
