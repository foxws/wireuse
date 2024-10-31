<?php

namespace Foxws\WireUse\Auth\Concerns;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

trait WithAuthentication
{
    protected function isAuthenticated(): bool
    {
        return Auth::check();
    }

    protected function getAuthId(): int|string|null
    {
        return Auth::id();
    }

    protected function getAuthModel(): ?User
    {
        return Auth::getUser();
    }

    protected function getAuthKey(): int|string|null
    {
        return $this->getAuthUser()?->getRouteKey();
    }

    protected function can(string $ability, mixed $arguments = []): bool
    {
        return Auth::user()?->can($ability, $arguments);
    }

    protected function cannot(string $ability, mixed $arguments = []): bool
    {
        return Auth::user()?->cannot($ability, $arguments);
    }
}
