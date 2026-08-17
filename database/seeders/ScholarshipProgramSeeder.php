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
                'description' => 'Học bổng dành cho sinh viên có kết quả học tập và rèn luyện tốt trong năm học.',
                'amount' => 5000000,
                'academic_year' => '2025-2026',
                'semester' => 1,
                'start_date' => '2026-01-01',
                'end_date' => '2026-06-30',
                'status' => 'active',
            ],
            [
                'name' => 'Học bổng Lê Văn Kiểm và Gia đình',
                'description' => 'Học bổng hỗ trợ sinh viên có thành tích học tập tốt, hoàn cảnh khó khăn và sinh viên có thành tích nổi bật.',
                'amount' => 15000000,
                'academic_year' => '2025-2026',
                'semester' => 1,
                'start_date' => '2026-01-10',
                'end_date' => '2026-06-30',
                'status' => 'active',
            ],
            [
                'name' => 'Học bổng Vingroup',
                'description' => 'Học bổng dành cho sinh viên có thành tích học tập tốt và đáp ứng các tiêu chí của chương trình tài trợ.',
                'amount' => 20000000,
                'academic_year' => '2025-2026',
                'semester' => 2,
                'start_date' => '2026-07-01',
                'end_date' => '2026-12-31',
                'status' => 'active',
            ],
            [
                'name' => 'Học bổng sinh viên xuất sắc',
                'description' => 'Dành cho sinh viên có kết quả học tập xuất sắc và thành tích rèn luyện tốt.',
                'amount' => 10000000,
                'academic_year' => '2025-2026',
                'semester' => 2,
                'start_date' => '2026-07-05',
                'end_date' => '2026-12-20',
                'status' => 'active',
            ],
            [
                'name' => 'Học bổng sinh viên có hoàn cảnh khó khăn',
                'description' => 'Hỗ trợ sinh viên có hoàn cảnh kinh tế khó khăn nhưng vẫn có kết quả học tập và rèn luyện đạt yêu cầu.',
                'amount' => 7000000,
                'academic_year' => '2025-2026',
                'semester' => 1,
                'start_date' => '2026-02-01',
                'end_date' => '2026-06-30',
                'status' => 'active',
            ],
            [
                'name' => 'Học bổng nghiên cứu khoa học',
                'description' => 'Dành cho sinh viên có thành tích trong hoạt động nghiên cứu khoa học.',
                'amount' => 8000000,
                'academic_year' => '2025-2026',
                'semester' => 2,
                'start_date' => '2026-08-01',
                'end_date' => '2026-12-31',
                'status' => 'active',
            ],
            [
                'name' => 'Học bổng sinh viên đạt thành tích học thuật',
                'description' => 'Dành cho sinh viên đạt thành tích cao trong các cuộc thi học thuật và chuyên môn.',
                'amount' => 9000000,
                'academic_year' => '2025-2026',
                'semester' => 2,
                'start_date' => '2026-09-01',
                'end_date' => '2026-12-30',
                'status' => 'active',
            ],
            [
                'name' => 'Học bổng Olympic sinh viên',
                'description' => 'Dành cho sinh viên đạt thành tích cao trong các kỳ thi Olympic và cuộc thi học thuật.',
                'amount' => 9000000,
                'academic_year' => '2025-2026',
                'semester' => 2,
                'start_date' => '2026-09-01',
                'end_date' => '2026-12-30',
                'status' => 'active',
            ],
            [
                'name' => 'Học bổng tài năng sinh viên',
                'description' => 'Dành cho sinh viên có thành tích nổi bật trong học tập, nghiên cứu, hoạt động xã hội hoặc phong trào sinh viên.',
                'amount' => 12000000,
                'academic_year' => '2025-2026',
                'semester' => 1,
                'start_date' => '2026-03-01',
                'end_date' => '2026-06-15',
                'status' => 'draft',
            ],
            [
                'name' => 'Học bổng sinh viên tiêu biểu',
                'description' => 'Dành cho sinh viên có thành tích toàn diện về học tập, rèn luyện và hoạt động phong trào.',
                'amount' => 12000000,
                'academic_year' => '2025-2026',
                'semester' => 2,
                'start_date' => '2026-08-15',
                'end_date' => '2026-12-31',
                'status' => 'active',
            ],
        ]);
    }
}