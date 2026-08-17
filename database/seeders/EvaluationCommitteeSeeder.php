<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationCommitteeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('evaluation_committees')->insert([
            [
                'name' => 'Hội đồng xét học bổng khuyến khích học tập',
                'description' => 'Hội đồng đánh giá hồ sơ học bổng khuyến khích học tập.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hội đồng xét học bổng Lê Văn Kiểm',
                'description' => 'Hội đồng đánh giá hồ sơ học bổng Lê Văn Kiểm.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hội đồng xét học bổng Vingroup',
                'description' => 'Hội đồng đánh giá hồ sơ học bổng Vingroup.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hội đồng xét sinh viên xuất sắc',
                'description' => 'Hội đồng đánh giá hồ sơ sinh viên xuất sắc.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hội đồng hỗ trợ sinh viên khó khăn',
                'description' => 'Hội đồng đánh giá hồ sơ sinh viên có hoàn cảnh khó khăn.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}