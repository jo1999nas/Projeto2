<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    // Proteção contra atribuição em massa
    protected $fillable = [
        'comment',
        'post_id',
        'account_id',
    ];

    // Cada comentário pertence a um post
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    // Cada comentário pertence a uma conta (autor do comentário)
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
