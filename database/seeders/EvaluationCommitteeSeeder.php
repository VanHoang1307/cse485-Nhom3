<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EvaluationCommittee;

class EvaluationCommitteeSeeder extends Seeder
{
    public function run(): void
    {
        EvaluationCommittee::insert([
            [
                'scholarship_program_id' => 1,
                'committee_name' => 'Hội đồng xét học bổng khuyến khích học tập',
                'chairman' => 'Nguyễn Văn An',
                'decision_date' => '2026-01-05',
                'status' => 'active',
            ],
            [
                'scholarship_program_id' => 2,
                'committee_name' => 'Hội đồng xét học bổng Lê Văn Kiểm',
                'chairman' => 'Trần Văn Bình',
                'decision_date' => '2026-01-08',
                'status' => 'active',
            ],
            [
                'scholarship_program_id' => 3,
                'committee_name' => 'Hội đồng xét học bổng Vingroup',
                'chairman' => 'Phạm Văn Cường',
                'decision_date' => '2026-06-25',
                'status' => 'active',
            ],
            [
                'scholarship_program_id' => 4,
                'committee_name' => 'Hội đồng xét sinh viên xuất sắc',
                'chairman' => 'Lê Văn Dũng',
                'decision_date' => '2026-07-01',
                'status' => 'active',
            ],
            [
                'scholarship_program_id' => 5,
                'committee_name' => 'Hội đồng hỗ trợ sinh viên khó khăn',
                'chairman' => 'Nguyễn Thị Lan',
                'decision_date' => '2026-01-25',
                'status' => 'active',
            ],
        ]);
    }
}