<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eligibility_rules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('scholarship_program_id')
                ->constrained('scholarship_programs')
                ->cascadeOnDelete();

            $table->decimal('min_gpa', 3, 2);
            $table->unsignedInteger('min_credits');

            $table->boolean('allow_debt_subject')
                ->default(false);

            $table->text('note')->nullable();

            $table->timestamps();

            // Không đặt unique ở scholarship_program_id
            // Một chương trình có thể có nhiều điều kiện
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eligibility_rules');
    }
};