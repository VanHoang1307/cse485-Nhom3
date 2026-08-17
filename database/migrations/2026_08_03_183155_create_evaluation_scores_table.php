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
        Schema::create('evaluation_scores', function (Blueprint $table) {
            $table->id();

            // Hồ sơ được chấm
            $table->foreignId('application_id')
                ->constrained('applications')
                ->cascadeOnDelete();

            // ID tiêu chí chấm điểm
            // Bảng scoring_criteria do Module 1 phụ trách
            $table->unsignedBigInteger('criterion_id');

            // ID hội đồng/người chấm
            // Bảng evaluation_committees do Module 1 phụ trách
            $table->unsignedBigInteger('committee_id');

            // Điểm
            $table->decimal('score', 5, 2);

            // Nhận xét của người chấm
            $table->text('comment')->nullable();

            $table->timestamps();

            /*
             * Một hồ sơ + một tiêu chí + một hội đồng
             * chỉ được có một bản ghi điểm.
             */
            $table->unique(
                [
                    'application_id',
                    'criterion_id',
                    'committee_id'
                ],
                'evaluation_score_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_scores');
    }
};