<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'location',
        'name',
        'gender',
        'phone',
        'category_id',
        'member_id'
    ];
    public function member(): BelongsTo
    {

        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
    public function category(): BelongsTo
    {

        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(
            Participant::class,
            ProgramParticipant::class,
            'program_id',
            'participant_id'
        )
            ->withTimestamps()
            ->withPivot(['certificate_Id', 'created_by']);
    }
    public function trainers(): BelongsToMany
    {
        return $this->belongsToMany(Trainer::class, ProgramTrainer::class, 'program_id', 'trainer_id')->withTimestamps();
    }
    public function programParticipants(): HasMany
    {
        return $this->hasMany(ProgramParticipant::class, 'program_id', 'id');
    }
}
