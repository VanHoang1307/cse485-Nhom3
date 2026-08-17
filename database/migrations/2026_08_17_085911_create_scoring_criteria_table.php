<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scoring_criteria', function (Blueprint $table) {
            $table->id();

            $table->foreignId('scholarship_program_id')
                ->constrained('scholarship_programs')
                ->cascadeOnDelete();

            $table->string('criteria_name', 255);

            $table->decimal('max_score', 5, 2);
            $table->decimal('weight', 5, 2);

            $table->text('description')->nullable();

            $table->timestamps();

            // Không cho phép trùng tên tiêu chí trong cùng chương trình
            $table->unique(
                ['scholarship_program_id', 'criteria_name'],
                'scoring_criteria_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scoring_criteria');
    }
};