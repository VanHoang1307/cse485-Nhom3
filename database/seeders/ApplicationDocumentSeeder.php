<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ApplicationDocument;

class ApplicationDocumentSeeder extends Seeder
{
    public function run(): void
    {
        ApplicationDocument::create([
            'application_id' => 1,
            'document_name' => 'Bảng điểm',
            'document_type' => 'PDF',
            'file_path' => 'uploads/bangdiem.pdf',
            'verification_status' => 'Approved'
        ]);
    }
}