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
    Schema::create('scholarship_programs', function (Blueprint $table) {

        $table->id();

        // Tên chương trình học bổng
        $table->string('name');

        // Mô tả
        $table->text('description')->nullable();

        // Giá trị học bổng
        $table->decimal('amount',12,2);

        // Năm học
        $table->string('academic_year',20);

        // Học kỳ
        $table->tinyInteger('semester');

        // Ngày bắt đầu
        $table->date('start_date');

        // Ngày kết thúc
        $table->date('end_date');

        // Trạng thái
        $table->enum('status',[
            'draft',
            'active',
            'closed'
        ]);

        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarship_programs');
    }
};
