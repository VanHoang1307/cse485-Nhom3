<?php

namespace Database\Seeders;

use App\Models\EvaluationCommittee;
use App\Models\ScholarshipProgram;
use Illuminate\Database\Seeder;

class EvaluationCommitteeSeeder extends Seeder
{
    public function run(): void
    {
        $programs = ScholarshipProgram::all();

        if ($programs->isEmpty()) {
            return;
        }

        EvaluationCommittee::insert([
            [
                'scholarship_program_id' => $programs[0]->id,
                'committee_name' => 'Hội đồng xét học bổng khuyến khích học tập',
                'chairman' => 'Nguyễn Văn A',
                'decision_date' => '2026-08-01',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'scholarship_program_id' => $programs[1]->id ?? $programs[0]->id,
                'committee_name' => 'Hội đồng xét học bổng Lê Văn Kiểm',
                'chairman' => 'Nguyễn Văn B',
                'decision_date' => '2026-08-02',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'scholarship_program_id' => $programs[2]->id ?? $programs[0]->id,
                'committee_name' => 'Hội đồng xét học bổng Vingroup',
                'chairman' => 'Nguyễn Văn C',
                'decision_date' => '2026-08-03',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'scholarship_program_id' => $programs[3]->id ?? $programs[0]->id,
                'committee_name' => 'Hội đồng xét sinh viên xuất sắc',
                'chairman' => 'Nguyễn Văn D',
                'decision_date' => '2026-08-04',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'scholarship_program_id' => $programs[4]->id ?? $programs[0]->id,
                'committee_name' => 'Hội đồng hỗ trợ sinh viên khó khăn',
                'chairman' => 'Nguyễn Văn E',
                'decision_date' => '2026-08-05',
                'status' => 'closed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

