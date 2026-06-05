<?php
// app/Models/Grade.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['enrolment_id', 'label', 'score', 'max_score'];

    protected function casts(): array
    {
        return [
            'score'     => 'decimal:2',
            'max_score' => 'decimal:2',
        ];
    }

    public function enrolment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Enrolment::class);
    }

    // Accessor — percentage score
    public function getPercentageAttribute(): float
    {
        if ($this->max_score == 0) return 0;
        return round(($this->score / $this->max_score) * 100, 1);
    }

    // Accessor — letter grade
    public function getLetterGradeAttribute(): string
    {
        return match(true) {
            $this->percentage >= 75 => 'A',
            $this->percentage >= 65 => 'B',
            $this->percentage >= 55 => 'C',
            $this->percentage >= 45 => 'D',
            default                 => 'F',
        };
    }
}