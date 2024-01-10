<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProgramParticipant extends Pivot
{
    use HasFactory;
    protected $table = 'program_participants';

    protected $fillable = [
        "certificate_id", "program_id", "participant_id"
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }
    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }
}
