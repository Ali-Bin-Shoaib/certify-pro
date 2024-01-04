<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'gender', 'phone', 'member_id'
    ];
    public function programs(): BelongsToMany
    {
        return $this->belongsToMany(Program::class, 'program_trainers', 'program_id', 'trainer_id');
    }
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

}
