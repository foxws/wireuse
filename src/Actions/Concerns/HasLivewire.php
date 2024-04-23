<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasLivewire
{
    public function wireNavigate(bool $value = true): static
    {
        $this->wireNavigate = $value;

        return $this;
    }

    public function shouldNavigate(): bool
    {
        return $this->value('wireNavigate', false);
    }
}
