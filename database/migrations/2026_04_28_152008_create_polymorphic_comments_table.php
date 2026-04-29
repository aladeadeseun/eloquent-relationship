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
        Schema::create('polymorphic_comments', function (Blueprint $table) {
            $table->id();
            $table->text("body");
            // Creates 'commentable_id' and 'commentable_type'
            $table->morphs("commentable");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polymorphic_comments');
    }
};
