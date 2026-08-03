<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create([
            'student_code' => '2251162032',
            'full_name' => 'Nguyễn Thị Thúy Hường',
            'gender' => 'Female',
            'date_of_birth' => '2004-06-12',
            'faculty' => 'Công nghệ thông tin',
            'major' => 'Hệ thống thông tin',
            'class' => '64HTTT',
            'email' => 'huong@gmail.com',
            'phone' => '0988888888',
            'gpa' => 3.65,
            'training_score' => 90,
            'status' => 'Active'
        ]);

        Student::create([
            'student_code' => '2251162015',
            'full_name' => 'Nguyễn Văn Hoàng',
            'gender' => 'Male',
            'date_of_birth' => '2004-05-20',
            'faculty' => 'Công nghệ thông tin',
            'major' => 'Khoa học máy tính',
            'class' => '64CNTT',
            'email' => 'hoang@gmail.com',
            'phone' => '0977777777',
            'gpa' => 3.45,
            'training_score' => 88,
            'status' => 'Active'
        ]);
    }
}