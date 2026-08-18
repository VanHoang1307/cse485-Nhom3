<?php

namespace Database\Seeders;

use App\Models\EvaluationCommittee;
use App\Models\ScholarshipProgram;
use Illuminate\Database\Seeder;

class EvaluationCommitteeSeeder extends Seeder
{
    public function run(): void
    {
        $programs = ScholarshipProgram::orderBy('id')->get();

        if ($programs->isEmpty()) {
            return;
        }

        $committees = [];

        $committeeNames = [
            'Hội đồng xét học bổng khuyến khích học tập',
            'Hội đồng xét học bổng Lê Văn Kiểm',
            'Hội đồng xét học bổng Vingroup',
            'Hội đồng xét sinh viên xuất sắc',
            'Hội đồng hỗ trợ sinh viên khó khăn',
        ];

        $chairmen = [
            'Nguyễn Văn A',
            'Nguyễn Văn B',
            'Nguyễn Văn C',
            'Nguyễn Văn D',
            'Nguyễn Văn E',
        ];

        foreach ($programs as $index => $program) {
            $nameIndex = $index % count($committeeNames);

            $committees[] = [
                'scholarship_program_id' => $program->id,
                'committee_name' => $committeeNames[$nameIndex],
                'chairman' => $chairmen[$nameIndex],
                'decision_date' => now()->subDays(20 - $index)->format('Y-m-d'),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        EvaluationCommittee::insert($committees);
    }
}