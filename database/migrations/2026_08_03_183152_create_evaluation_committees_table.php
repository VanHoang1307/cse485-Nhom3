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

            $table->string('committee_name');

            $table->string('chairman');

            $table->date('decision_date');

            $table->enum('status', [
                'active',
                'closed',
            ])->default('active');

            $table->timestamps();

            $table->unique(
                ['scholarship_program_id', 'committee_name'],
                'committee_program_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluation_committees');
    }
};

