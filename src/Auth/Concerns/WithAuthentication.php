<?php

namespace Foxws\WireUse\Auth\Concerns;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        if (! $this->isAuthenticated()) {
            return null;
        }

        return $this->getAuthModel()->getRouteKey();
    }

    protected function can(string $ability, mixed $arguments = []): bool
    {
        return Gate::allows($ability, $arguments);
    }

    protected function cannot(string $ability, mixed $arguments = []): bool
    {
        return Gate::denies($ability, $arguments);
    }
}
