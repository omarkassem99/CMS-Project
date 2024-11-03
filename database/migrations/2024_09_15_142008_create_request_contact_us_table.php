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
        Schema::create('request_contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('company');
            $table->string('email');
            $table->string('country_code');
            $table->string('phone');
            $table->string('country');
            $table->integer('project_budget');
            $table->string('service');
            $table->text('details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_contact_us');
    }
};
