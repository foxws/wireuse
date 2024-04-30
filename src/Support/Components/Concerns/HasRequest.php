<?php

namespace Foxws\WireUse\Support\Components\Concerns;

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
        $url = str($this->value('url', ''))->trim();

        return $url->is('/') || $url->startsWith(config('app.url'));
    }

    public function fullUrlIs(): bool
    {
        return ($url = $this->getUrl()) && request()->fullUrlIs($url);
    }
}
