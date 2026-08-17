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
        Schema::create('ranking_results', function (Blueprint $table) {
            $table->id();

            // Mỗi hồ sơ chỉ có một kết quả xếp hạng
            $table->foreignId('application_id')
                ->unique()
                ->constrained('applications')
                ->cascadeOnDelete();

            // Tổng điểm
            $table->decimal('total_score', 5, 2);

            // Thứ hạng
            $table->integer('ranking');

            // Kết quả
            $table->enum('result', [
                'Qualified',
                'Not Qualified',
                'Waiting'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranking_results');
    }
};