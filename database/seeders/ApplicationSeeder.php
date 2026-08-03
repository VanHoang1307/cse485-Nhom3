<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        Application::create([
            'student_id' => 1,
            'scholarship_program_id' => 1,
            'application_code' => 'APP001',
            'apply_date' => now(),
            'status' => 'Pending',
            'review_note' => 'Đang chờ xét duyệt'
        ]);

        Application::create([
            'student_id' => 2,
            'scholarship_program_id' => 1,
            'application_code' => 'APP002',
            'apply_date' => now(),
            'status' => 'Approved',
            'review_note' => 'Đủ điều kiện'
        ]);
    }
}