<?php

namespace Foxws\WireUse\Forms\Concerns;

use Illuminate\Validation\ValidationException;

trait WithValidation
{
    protected static bool $recoverable = false;

    public function check(): void
    {
        if (! static::isRecoverable()) {
            $this->validate();

            return;
        }

        rescue(
            fn () => $this->validate(),
            fn () => $this->reset(),
        );
    }

    public function hasMessages(): bool
    {
        return $this->getErrorBag()->isNotEmpty();
    }

    protected static function isRecoverable(): bool
    {
        return static::$recoverable;
    }
}
