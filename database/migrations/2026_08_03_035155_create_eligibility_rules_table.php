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
        Schema::create('eligibility_rules', function (Blueprint $table) {

            $table->id();

            // Liên kết với bảng scholarship_programs
            $table->foreignId('scholarship_program_id')
                  ->constrained('scholarship_programs')
                  ->cascadeOnDelete();

            // Điểm GPA tối thiểu
            $table->decimal('min_gpa', 3, 2);

            // Số tín chỉ tối thiểu
            $table->integer('min_credits');

            // Có cho phép nợ môn hay không
            // 0: Không cho phép
            // 1: Cho phép
            $table->boolean('allow_debt_subject')
                  ->default(false);

            // Ghi chú thêm
            $table->text('note')->nullable();

            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eligibility_rules');
    }
};