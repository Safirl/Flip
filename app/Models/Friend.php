<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperFriend
 */
class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id_1',
        'user_id_2',
    ];
}
