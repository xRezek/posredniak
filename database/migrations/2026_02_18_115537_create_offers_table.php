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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('title', 100);
            $table->longText('description');
            $table->string('pay');
            $table->boolean('experience_required');
            $table->string('localization');
            $table->foreignId('place_of_work_id')->constrained('places_of_work');
            $table->foreignId('type_of_contracts')->constrained('types_of_contract');
            $table->string('company_name', 100);
            $table->string('contact', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
