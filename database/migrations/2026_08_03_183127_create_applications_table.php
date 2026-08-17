```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            // Sinh viên nộp hồ sơ
            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            // Chương trình học bổng
            $table->foreignId('scholarship_program_id')
                ->constrained('scholarship_programs')
                ->cascadeOnDelete();

            // Mã hồ sơ
            $table->string('application_code')->unique();

            // Ngày nộp hồ sơ
            $table->date('apply_date');

            // Trạng thái hồ sơ
            $table->enum('status', [
                'Pending',
                'Approved',
                'Rejected'
            ]);

            // Ghi chú xét duyệt
            $table->text('review_note')->nullable();

            $table->timestamps();

            // Một sinh viên không thể đăng ký cùng một học bổng 2 lần
            $table->unique(
                ['student_id', 'scholarship_program_id'],
                'student_program_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};

