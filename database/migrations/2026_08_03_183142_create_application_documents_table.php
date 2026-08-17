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
        Schema::create('application_documents', function (Blueprint $table) {
            $table->id();

            // Hồ sơ sở hữu minh chứng
            $table->foreignId('application_id')
                ->constrained('applications')
                ->cascadeOnDelete();

            // Tên minh chứng
            $table->string('document_name');

            // Đường dẫn file
            $table->string('file_path');

            // Ngày upload
            $table->date('upload_date')->nullable();

            // Trạng thái minh chứng
            $table->enum('status', [
                'Pending',
                'Approved',
                'Rejected'
            ])->default('Pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_documents');
    }
};