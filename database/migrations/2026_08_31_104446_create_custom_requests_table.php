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
        Schema::create('custom_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status')->default('draft');
            $table->unsignedTinyInteger('last_step_reached')->default(0);
            $table->string('contact_method')->nullable();
            $table->string('contact_value')->nullable();
            $table->text('message')->nullable();
            $table->json('selected_options')->nullable();
            $table->unsignedInteger('estimated_price')->nullable();
            $table->string('reference_image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_requests');
    }
};
