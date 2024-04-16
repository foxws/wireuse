<?php

namespace Foxws\WireUse\Support\Concerns;

use Foxws\WireUse\Exceptions\RateLimitedException;
use Illuminate\Support\Facades\RateLimiter;

trait WithRateLimiting
{
    protected static int $maxAttempts = 0;

    protected static int $decaySeconds = 60;

    protected function rateLimit(): void
    {
        $maxAttempts = static::getMaxAttempts();

        if ($maxAttempts < 1) {
            return;
        }

        $key = static::getRateLimitKey();

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            throw new RateLimitedException(
                request()->ip(),
                RateLimiter::availableIn($key)
            );
        }

        static::incrementRateLimiter();
    }

    protected static function incrementRateLimiter(): void
    {
        RateLimiter::increment(
            static::getRateLimitKey(),
            static::getDecaySeconds()
        );
    }

    protected static function clearRateLimiter(): void
    {
        RateLimiter::clear(static::getRateLimitKey());
    }

    protected static function getRateLimitKey(): string
    {
        return hash('crc32c', serialize([
            get_called_class(), request()->ip(),
        ]));
    }

    protected static function getMaxAttempts(): int
    {
        return static::$maxAttempts;
    }

    protected static function getDecaySeconds(): int
    {
        return static::$decaySeconds;
    }
}
