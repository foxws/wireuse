<?php

namespace Foxws\WireUse\Views\Concerns;

trait WithLivewire
{
    public function wireKey(): ?string
    {
        return $this->attributes->get('id', $this->wireModel());
    }

    public function wireModel(): ?string
    {
        return $this->attributes->wireModel();
    }
}
