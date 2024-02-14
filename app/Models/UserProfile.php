<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'avatar_path',
        'date_of_birth',
        'city',
        'country',
        'bio'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
