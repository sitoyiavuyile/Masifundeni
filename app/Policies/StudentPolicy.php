<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudentPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true;
        }
        return null;
    }

    public function viewAny(User $user): bool  { return false; }
    public function view(User $user, User $model): bool { return false; }
    public function create(User $user): bool   { return false; }
    public function update(User $user, User $model): bool { return false; }
    public function delete(User $user, User $model): bool { return false; }
}