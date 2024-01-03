<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Participant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'gender', 'email', 'phone'
    ];
    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'program_participant', 'program_id', 'participant_id');
    }
}
