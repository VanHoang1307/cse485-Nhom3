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
        Schema::create('evaluation_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->unsignedBigInteger('criterion_id');
            $table->unsignedBigInteger('committee_id');
            $table->decimal('score',5,2);
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->unique(
            ['application_id', 'criterion_id', 'committee_id'],
            'eval_score_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_scores');
    }
};
