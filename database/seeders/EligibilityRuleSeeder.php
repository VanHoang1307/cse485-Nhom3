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
                'note' => 'GPA từ 3.20 trở lên, không nợ môn.'
            ],

            [
                'scholarship_program_id' => 2,
                'min_gpa' => 2.50,
                'min_credits' => 12,
                'allow_debt_subject' => true,
                'note' => 'Ưu tiên sinh viên có hoàn cảnh khó khăn.'
            ],

            [
                'scholarship_program_id' => 3,
                'min_gpa' => 3.60,
                'min_credits' => 18,
                'allow_debt_subject' => false,
                'note' => 'Có thành tích học tập xuất sắc.'
            ],

            [
                'scholarship_program_id' => 4,
                'min_gpa' => 3.30,
                'min_credits' => 16,
                'allow_debt_subject' => false,
                'note' => 'Có đề tài nghiên cứu khoa học.'
            ],

            [
                'scholarship_program_id' => 5,
                'min_gpa' => 3.50,
                'min_credits' => 18,
                'allow_debt_subject' => false,
                'note' => 'Sinh viên ngành CNTT.'
            ],

            [
                'scholarship_program_id' => 6,
                'min_gpa' => 3.00,
                'min_credits' => 14,
                'allow_debt_subject' => true,
                'note' => 'Theo tiêu chí doanh nghiệp.'
            ],

            [
                'scholarship_program_id' => 7,
                'min_gpa' => 2.80,
                'min_credits' => 12,
                'allow_debt_subject' => true,
                'note' => 'Dành cho tân sinh viên.'
            ],

            [
                'scholarship_program_id' => 8,
                'min_gpa' => 3.40,
                'min_credits' => 16,
                'allow_debt_subject' => false,
                'note' => 'Đạt giải các cuộc thi học thuật.'
            ],

            [
                'scholarship_program_id' => 9,
                'min_gpa' => 3.00,
                'min_credits' => 15,
                'allow_debt_subject' => false,
                'note' => 'Có hoạt động ngoại khóa tích cực.'
            ],

            [
                'scholarship_program_id' => 10,
                'min_gpa' => 3.70,
                'min_credits' => 20,
                'allow_debt_subject' => false,
                'note' => 'Sinh viên ưu tú toàn diện.'
            ],

        ]);
    }
}