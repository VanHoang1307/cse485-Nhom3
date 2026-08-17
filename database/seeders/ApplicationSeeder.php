<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        Application::insert([
            [
                'student_id' => 1,
                'scholarship_program_id' => 1,
                'application_code' => 'APP001',
                'apply_date' => '2026-08-01',
                'status' => 'Pending',
                'review_note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 2,
                'scholarship_program_id' => 1,
                'application_code' => 'APP002',
                'apply_date' => '2026-08-02',
                'status' => 'Pending',
                'review_note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 3,
                'scholarship_program_id' => 1,
                'application_code' => 'APP003',
                'apply_date' => '2026-08-03',
                'status' => 'Approved',
                'review_note' => 'Hồ sơ đạt yêu cầu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 4,
                'scholarship_program_id' => 2,
                'application_code' => 'APP004',
                'apply_date' => '2026-08-04',
                'status' => 'Pending',
                'review_note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 5,
                'scholarship_program_id' => 2,
                'application_code' => 'APP005',
                'apply_date' => '2026-08-05',
                'status' => 'Approved',
                'review_note' => 'Đủ điều kiện nhận học bổng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 6,
                'scholarship_program_id' => 3,
                'application_code' => 'APP006',
                'apply_date' => '2026-08-06',
                'status' => 'Rejected',
                'review_note' => 'Không đủ điều kiện.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 7,
                'scholarship_program_id' => 3,
                'application_code' => 'APP007',
                'apply_date' => '2026-08-07',
                'status' => 'Approved',
                'review_note' => 'Hồ sơ hợp lệ.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 8,
                'scholarship_program_id' => 4,
                'application_code' => 'APP008',
                'apply_date' => '2026-08-08',
                'status' => 'Pending',
                'review_note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 9,
                'scholarship_program_id' => 4,
                'application_code' => 'APP009',
                'apply_date' => '2026-08-09',
                'status' => 'Approved',
                'review_note' => 'Hồ sơ đạt yêu cầu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 10,
                'scholarship_program_id' => 5,
                'application_code' => 'APP010',
                'apply_date' => '2026-08-10',
                'status' => 'Pending',
                'review_note' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}