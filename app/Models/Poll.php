<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin IdeHelperPoll
 */
class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote',
        'author',
        'context',
        'analysis',
        'title',
        'slug',
        'published_at',
        'image',
        'source',
        'date',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_poll');
    }

    public function imageUrl(): string
    {
        return Storage::disk('public')->url($this->image);
    }
}
