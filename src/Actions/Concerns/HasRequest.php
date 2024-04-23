<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasRequest
{
    public function url(?string $url = null): static
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->value('url');
    }

    public function isAppUrl(): bool
    {
        $url = str($this->getUrl())->trim();

        return $url->is('/') || $url->startsWith(config('app.url'));
    }
}
