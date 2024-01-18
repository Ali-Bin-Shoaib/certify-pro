<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgramTrainer extends Pivot
{
    use HasFactory;
    protected $table = 'program_trainers';
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

}
