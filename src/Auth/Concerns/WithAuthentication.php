<?php

namespace Foxws\WireUse\Auth\Concerns;

use Illuminate\Foundation\Auth\User;

trait WithAuthentication
{
    protected function isAuthenticated(): bool
    {
        return auth()->check();
    }

    protected function getAuthId(): int|string|null
    {
        return auth()->id();
    }

    protected function getAuthModel(): ?User
    {
        return auth()->user();
    }

    protected function getAuthKey(): int|string|null
    {
        return $this->getAuthModel()?->getRouteKey();
    }

    protected function can(string $ability, mixed $arguments = []): bool
    {
        return $this->getAuthModel()?->can($ability, $arguments);
    }

    protected function cannot(string $ability, mixed $arguments = []): bool
    {
        return $this->getAuthModel()?->cannot($ability, $arguments);
    }
}
