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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->morphs('reviewable');
            $table->foreignIdFor(\App\Models\Customer::class)->constrained()->cascadeOnDelete();
            $table->text('body')->nullable();
            $table->integer('rating')->default(0);
            $table->string('title')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropMorphs('reviewable');
            $table->dropForeignIdFor(\App\Models\User::class);
        });
        Schema::dropIfExists('reviews');
    }
};
