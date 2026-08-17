<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluation_scores', function (Blueprint $table) {
            $table->id();

            // Hồ sơ được chấm
            $table->foreignId('application_id')
                ->constrained('applications')
                ->cascadeOnDelete();

            // Tiêu chí chấm điểm
            $table->foreignId('criterion_id')
                ->constrained('scoring_criteria')
                ->cascadeOnDelete();

            // Hội đồng/người chấm
            $table->foreignId('committee_id')
                ->constrained('evaluation_committees')
                ->cascadeOnDelete();

            // Điểm
            $table->decimal('score', 5, 2);

            // Nhận xét của người chấm
            $table->text('comment')->nullable();

            $table->timestamps();

            // Một hồ sơ + một tiêu chí + một hội đồng
            // chỉ được có một bản ghi điểm
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

    public function down(): void
    {
        Schema::dropIfExists('evaluation_scores');
    }
};

