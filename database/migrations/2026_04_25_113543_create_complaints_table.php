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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('complaint_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number');
            $table->string('product_name');
            $table->enum('damage_category', ['Pecah/Retak', 'Salah Warna', 'Tidak Berfungsi', 'Mati Total', 'Lainnya']);
            $table->text('description');
            $table->string('refund_method');
            $table->string('proof_image_path')->nullable();
            $table->string('unboxing_video_path')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'approved', 'rejected', 'done'])->default('pending');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
