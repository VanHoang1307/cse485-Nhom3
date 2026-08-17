<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarship_programs', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->text('description')->nullable();

            $table->decimal('amount', 12, 2);
            $table->string('academic_year', 20);
            $table->unsignedTinyInteger('semester');

            $table->date('start_date');
            $table->date('end_date');

            $table->enum('status', [
                'draft',
                'active',
                'closed'
            ])->default('draft');

            $table->timestamps();

            // Không cho phép trùng tên chương trình trong cùng năm học và học kỳ
            $table->unique(
                ['name', 'academic_year', 'semester'],
                'scholarship_program_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarship_programs');
    }
};