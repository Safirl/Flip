<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

use function auth;

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
        'is_intox',
    ];

    protected $casts = [
        'is_intox' => 'boolean',
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
        return $this
            ->belongsToMany(User::class, 'user_poll')
            ->withPivot('answer');
    }

    public function userWhoVotedInfo(): BelongsToMany
    {
        return $this->users()->withPivotValue('answer', 0);
    }

    public function userWhoVotedIntox(): BelongsToMany
    {
        return $this->users()->withPivotValue('answer', 1);
    }

    public function intoxCount(): int
    {
        return $this->userWhoVotedInfo->count();
    }

    public function infoCount(): int
    {
        return $this->userWhoVotedInfo->count();
    }

    public function getUserAnswerAttribute()
    {
        $currentUser = auth()->user();

        if (! $currentUser) {
            return null;
        }

        return $this->users->where('id', $currentUser->id)->first()?->pivot->answer;
    }

    public function imageUrl(): string
    {
        return Storage::disk('public')->url($this->image);
    }
}
