<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Account extends Model
{
    use HasFactory;
    
    // Proteção contra atribuição em massa
    protected $fillable = [
        'name',
        'user_id',
    ];

    // Uma conta pertence a um usuário
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Uma conta pode ter muitos posts
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    // Uma conta pode ter muitos comentários
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Os seguidores desta conta
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'follow', 'followed_id', 'follower_id');
    }

    // As contas que esta conta segue.
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(Account::class, 'follow', 'follower_id', 'followed_id');
    }
}
