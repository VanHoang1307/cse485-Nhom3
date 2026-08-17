```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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

            // Loại minh chứng
            $table->string('document_type');

            // Đường dẫn file
            $table->string('file_path');

            // Trạng thái xác minh
            $table->enum('verification_status', [
                'Pending',
                'Approved',
                'Rejected'
            ])->default('Pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_documents');
    }
};

