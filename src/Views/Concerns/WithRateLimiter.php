<?php

namespace Foxws\WireUse\Views\Concerns;

use Foxws\WireUse\Exceptions\RateLimitedException;
use Illuminate\Support\Facades\RateLimiter;

trait WithRateLimiter
{
    protected static int $maxAttempts = 0;

    protected static int $decaySeconds = 60;

    protected function rateLimit(): void
    {
        $maxAttempts = $this->getMaxAttempts();

        if ($maxAttempts < 1) {
            return;
        }

        $key = $this->getRateLimitKey();

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            throw new RateLimitedException(
                request()->ip(),
                RateLimiter::availableIn($key)
            );
        }

        $this->incrementRateLimiter();
    }

    protected function incrementRateLimiter(): void
    {
        RateLimiter::increment(
            key: $this->getRateLimitKey(),
            decaySeconds: $this->getDecaySeconds(),
            amount: $this->getRateLimitAmount(),
        );
    }

    protected function clearRateLimiter(): void
    {
        RateLimiter::clear($this->getRateLimitKey());
    }

    protected function getRateLimitKey(): string
    {
        return hash('xxh128', serialize([
            get_called_class(), request()->ip(),
        ]));
    }

    protected function getMaxAttempts(): int
    {
        return static::$maxAttempts;
    }

    protected function getDecaySeconds(): int
    {
        return static::$decaySeconds;
    }

    protected function getRateLimitAmount(): int
    {
        return 1;
    }
}
