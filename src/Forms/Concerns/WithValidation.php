<?php

namespace Foxws\WireUse\Forms\Concerns;

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
            report: false,
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
