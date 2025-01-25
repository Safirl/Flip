<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    // Pas plus de détails pour le moment, l'admin a tous les droits.
    public function doAdminActions(User $user): bool
    {
        return $user->is_admin;
    }
}
