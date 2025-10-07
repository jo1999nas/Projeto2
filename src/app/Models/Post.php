<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    // Proteção contra atribuição em massa
    protected $fillable = [
        'body',
        'account_id',
    ];

    // Cada post pertence a uma conta
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    // Cada post pode ter muitos comentários
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
