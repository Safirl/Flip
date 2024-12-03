<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperComment
 */
class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'poll_id',
        'user_id',
        'parent_id',
    ];
}
