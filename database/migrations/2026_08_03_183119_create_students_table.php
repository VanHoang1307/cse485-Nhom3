<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('student_code')->unique();
        $table->string('full_name');
        $table->enum('gender',['Male','Female','Other']);
        $table->date('date_of_birth')->nullable();
        $table->string('faculty');
        $table->string('major');
        $table->string('class');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->decimal('gpa',3,2);
        $table->decimal('training_score', 5, 2)->default(0);
        $table->string('status')->default('Active');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
