<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'gender', 'email', 'phone', 'member_id', 'program_id'
    ];
    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, ProgramParticipant::class, 'program_id', 'participant_id')
            ->withTimestamps()
            ->withPivot(['certificate_id', 'created_by']);
    }
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
    public function programParticipants(): HasMany
    {
        return $this->hasMany(ProgramParticipant::class, 'participant_id', 'id');
    }
}
