<?php

namespace Foxws\WireUse\Auth\Concerns;

use Illuminate\Foundation\Auth\User;

trait WithAuthentication
{
    protected static function isAuthenticated(): bool
    {
        return auth()->check();
    }

    protected static function getAuthUser(): ?User
    {
        return auth()->user();
    }

    protected static function getAuthId(): int|string|null
    {
        return auth()->id();
    }

    protected static function getAuthKey(): int|string|null
    {
        return static::getAuthUser()?->getRouteKey();
    }
}
