<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\ApplicationDocument;
use Illuminate\Database\Seeder;

class ApplicationDocumentSeeder extends Seeder
{
    public function run(): void
    {
        $applications = Application::all();

        foreach ($applications as $application) {
            ApplicationDocument::create([
                'application_id' => $application->id,
                'document_name' => 'Bảng điểm học tập',
                'document_type' => 'Transcript',
                'file_path' => 'documents/transcript_' . $application->id . '.pdf',
                'verification_status' => 'Pending',
            ]);

            ApplicationDocument::create([
                'application_id' => $application->id,
                'document_name' => 'Giấy chứng nhận thành tích',
                'document_type' => 'Certificate',
                'file_path' => 'documents/certificate_' . $application->id . '.pdf',
                'verification_status' => 'Pending',
            ]);
        }
    }
}