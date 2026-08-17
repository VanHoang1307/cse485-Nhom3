<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ScoringCriterion;

class ScoringCriterionSeeder extends Seeder
{
    public function run(): void
    {
        ScoringCriterion::insert([
            [
                'scholarship_program_id' => 1,
                'criteria_name' => 'Điểm trung bình học tập',
                'max_score' => 10,
                'weight' => 50,
                'description' => 'Đánh giá dựa trên kết quả học tập của sinh viên.',
            ],
            [
                'scholarship_program_id' => 1,
                'criteria_name' => 'Điểm rèn luyện',
                'max_score' => 10,
                'weight' => 30,
                'description' => 'Đánh giá kết quả rèn luyện của sinh viên.',
            ],
            [
                'scholarship_program_id' => 1,
                'criteria_name' => 'Hoạt động ngoại khóa',
                'max_score' => 10,
                'weight' => 20,
                'description' => 'Đánh giá mức độ tham gia hoạt động ngoại khóa.',
            ],
            [
                'scholarship_program_id' => 2,
                'criteria_name' => 'Kết quả học tập',
                'max_score' => 10,
                'weight' => 40,
                'description' => 'Đánh giá kết quả học tập.',
            ],
            [
                'scholarship_program_id' => 2,
                'criteria_name' => 'Hoàn cảnh gia đình',
                'max_score' => 10,
                'weight' => 40,
                'description' => 'Đánh giá hoàn cảnh kinh tế của sinh viên.',
            ],
            [
                'scholarship_program_id' => 2,
                'criteria_name' => 'Hoạt động xã hội',
                'max_score' => 10,
                'weight' => 20,
                'description' => 'Đánh giá hoạt động xã hội.',
            ],
            [
                'scholarship_program_id' => 3,
                'criteria_name' => 'GPA',
                'max_score' => 10,
                'weight' => 60,
                'description' => 'Đánh giá thành tích học tập.',
            ],
            [
                'scholarship_program_id' => 3,
                'criteria_name' => 'Nghiên cứu khoa học',
                'max_score' => 10,
                'weight' => 40,
                'description' => 'Đánh giá thành tích nghiên cứu khoa học.',
            ],
        ]);
    }
}