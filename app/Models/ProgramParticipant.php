<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramParticipant extends Model
{
    use HasFactory;

    public function program():BelongsTo{
        return $this->belongsTo(Program::class);
    }
    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }

}
