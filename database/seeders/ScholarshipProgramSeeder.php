<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ScholarshipProgram;

class ScholarshipProgramSeeder extends Seeder
{
    public function run(): void
    {
        ScholarshipProgram::insert([

            [
                'name' => 'Học bổng khuyến khích học tập',
                'description' => 'Dành cho sinh viên có thành tích học tập tốt',
                'amount' => 5000000,
                'academic_year' => 2026,
                'semester' => 1,
                'start_date' => '2026-01-01',
                'end_date' => '2026-06-30',
                'status' => 'active',
            ],

            [
                'name' => 'Học bổng vượt khó',
                'description' => 'Hỗ trợ sinh viên có hoàn cảnh khó khăn',
                'amount' => 3000000,
                'academic_year' => 2026,
                'semester' => 1,
                'start_date' => '2026-01-10',
                'end_date' => '2026-06-30',
                'status' => 'active',
            ],

            [
                'name' => 'Học bổng tài năng trẻ',
                'description' => 'Dành cho sinh viên có thành tích nổi bật',
                'amount' => 7000000,
                'academic_year' => 2026,
                'semester' => 2,
                'start_date' => '2026-07-01',
                'end_date' => '2026-12-31',
                'status' => 'active',
            ],

            [
                'name' => 'Học bổng nghiên cứu khoa học',
                'description' => 'Dành cho sinh viên tham gia nghiên cứu',
                'amount' => 6000000,
                'academic_year' => 2026,
                'semester' => 2,
                'start_date' => '2026-07-05',
                'end_date' => '2026-12-20',
                'status' => 'active',
            ],

            [
                'name' => 'Học bổng CNTT xuất sắc',
                'description' => 'Dành cho sinh viên ngành công nghệ thông tin',
                'amount' => 8000000,
                'academic_year' => 2026,
                'semester' => 1,
                'start_date' => '2026-02-01',
                'end_date' => '2026-06-30',
                'status' => 'active',
            ],

            [
                'name' => 'Học bổng doanh nghiệp ABC',
                'description' => 'Tài trợ từ doanh nghiệp cho sinh viên',
                'amount' => 10000000,
                'academic_year' => 2026,
                'semester' => 2,
                'start_date' => '2026-08-01',
                'end_date' => '2026-12-31',
                'status' => 'active',
            ],

            [
                'name' => 'Học bổng hỗ trợ tân sinh viên',
                'description' => 'Hỗ trợ sinh viên năm nhất',
                'amount' => 2000000,
                'academic_year' => 2026,
                'semester' => 1,
                'start_date' => '2026-01-15',
                'end_date' => '2026-05-30',
                'status' => 'inactive',
            ],

            [
                'name' => 'Học bổng Olympic sinh viên',
                'description' => 'Dành cho sinh viên đạt giải cuộc thi',
                'amount' => 9000000,
                'academic_year' => 2026,
                'semester' => 2,
                'start_date' => '2026-09-01',
                'end_date' => '2026-12-30',
                'status' => 'active',
            ],

            [
                'name' => 'Học bổng kỹ năng mềm',
                'description' => 'Khuyến khích sinh viên phát triển kỹ năng',
                'amount' => 3500000,
                'academic_year' => 2026,
                'semester' => 1,
                'start_date' => '2026-03-01',
                'end_date' => '2026-06-15',
                'status' => 'inactive',
            ],

            [
                'name' => 'Học bổng sinh viên ưu tú',
                'description' => 'Dành cho sinh viên có thành tích toàn diện',
                'amount' => 12000000,
                'academic_year' => 2026,
                'semester' => 2,
                'start_date' => '2026-08-15',
                'end_date' => '2026-12-31',
                'status' => 'active',
            ],

        ]);
    }
}