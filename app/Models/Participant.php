<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Participant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'gender', 'email', 'phone', 'member_id'
    ];
    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, ProgramParticipant::class, 'program_id', 'participant_id')
            ->withPivot(['certificate_id', 'created_by']);
    }
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
