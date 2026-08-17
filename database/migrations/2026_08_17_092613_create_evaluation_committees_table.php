<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluation_committees', function (Blueprint $table) {
            $table->id();

            $table->foreignId('scholarship_program_id')
                ->constrained('scholarship_programs')
                ->cascadeOnDelete();

            $table->string('committee_name', 255);
            $table->string('chairman', 255);
            $table->date('decision_date');

            $table->enum('status', [
                'active',
                'closed'
            ])->default('active');

            $table->timestamps();

            // Không trùng tên hội đồng trong cùng chương trình
            $table->unique(
                ['scholarship_program_id', 'committee_name'],
                'evaluation_committee_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluation_committees');
    }
};