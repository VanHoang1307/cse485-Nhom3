<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EligibilityRule;

class EligibilityRuleSeeder extends Seeder
{
    public function run(): void
    {
        EligibilityRule::insert([
            [
                'scholarship_program_id' => 1,
                'min_gpa' => 3.20,
                'min_credits' => 15,
                'allow_debt_subject' => false,
                'note' => 'GPA từ 3.20 trở lên, đủ số tín chỉ và không được nợ môn.',
            ],
            [
                'scholarship_program_id' => 2,
                'min_gpa' => 2.80,
                'min_credits' => 12,
                'allow_debt_subject' => false,
                'note' => 'Ưu tiên sinh viên có hoàn cảnh khó khăn, có kết quả học tập và rèn luyện đạt yêu cầu, không nợ môn.',
            ],
            [
                'scholarship_program_id' => 3,
                'min_gpa' => 3.20,
                'min_credits' => 15,
                'allow_debt_subject' => false,
                'note' => 'Có kết quả học tập tốt, đáp ứng tiêu chí của chương trình và không nợ môn.',
            ],
            [
                'scholarship_program_id' => 4,
                'min_gpa' => 3.50,
                'min_credits' => 18,
                'allow_debt_subject' => false,
                'note' => 'Sinh viên có thành tích học tập xuất sắc và không nợ môn.',
            ],
            [
                'scholarship_program_id' => 5,
                'min_gpa' => 2.80,
                'min_credits' => 12,
                'allow_debt_subject' => false,
                'note' => 'Sinh viên có hoàn cảnh khó khăn nhưng vẫn duy trì kết quả học tập đạt yêu cầu và không nợ môn.',
            ],
            [
                'scholarship_program_id' => 6,
                'min_gpa' => 3.00,
                'min_credits' => 15,
                'allow_debt_subject' => false,
                'note' => 'Có tham gia nghiên cứu khoa học, kết quả học tập đạt yêu cầu và không nợ môn.',
            ],
            [
                'scholarship_program_id' => 7,
                'min_gpa' => 3.20,
                'min_credits' => 15,
                'allow_debt_subject' => false,
                'note' => 'Có thành tích trong các cuộc thi học thuật và không nợ môn.',
            ],
            [
                'scholarship_program_id' => 8,
                'min_gpa' => 3.20,
                'min_credits' => 15,
                'allow_debt_subject' => false,
                'note' => 'Đạt thành tích cao trong các kỳ thi Olympic sinh viên và không nợ môn.',
            ],
            [
                'scholarship_program_id' => 9,
                'min_gpa' => 3.30,
                'min_credits' => 15,
                'allow_debt_subject' => false,
                'note' => 'Có thành tích nổi bật trong học tập, nghiên cứu hoặc hoạt động sinh viên và không nợ môn.',
            ],
            [
                'scholarship_program_id' => 10,
                'min_gpa' => 3.50,
                'min_credits' => 18,
                'allow_debt_subject' => false,
                'note' => 'Sinh viên có thành tích toàn diện về học tập, rèn luyện và hoạt động phong trào, không nợ môn.',
            ],
        ]);
    }
}