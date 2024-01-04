<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends User
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
        'organization_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];


    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'member_id', 'id');
    }
    public function programs(): HasMany
    {
        return $this->hasMany(Program::class, 'member_id', 'id');
    }
    public function trainers(): HasMany
    {
        return $this->hasMany(Trainer::class, 'member_id', 'id');
    }
    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class, 'member_id', 'id');
    }
}
