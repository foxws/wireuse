<?php

namespace Foxws\WireUse\Auth\Concerns;

use Illuminate\Foundation\Auth\User;

trait WithAuthentication
{
    protected function isAuthenticated(): bool
    {
        return auth()->check();
    }

    protected function getAuthUser(): ?User
    {
        return auth()->user();
    }

    protected function getAuthId(): int|string|null
    {
        return auth()->id();
    }

    protected function getAuthKey(): int|string|null
    {
        return $this->getAuthUser()?->getRouteKey();
    }

    protected function can(string $ability, mixed $arguments = []): bool
    {
        return $this->getAuthUser()->can($ability, $arguments);
    }

    protected function cannot(string $ability, mixed $arguments = []): bool
    {
        return $this->getAuthUser()->cannot($ability, $arguments);
    }
}
