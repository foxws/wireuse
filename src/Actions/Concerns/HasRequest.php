<?php

namespace Foxws\WireUse\Actions\Concerns;

trait HasRequest
{
    public function url(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function navigate(bool $value = true): static
    {
        $this->navigate = $value;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->value('url');
    }

    public function shouldNavigate(): bool
    {
        return $this->value('navigate', $this->isAppUrl());
    }

    public function isAppUrl(): bool
    {
        $url = str($this->getUrl())->trim();

        return $url->is('/') || $url->startsWith(config('app.url'));
    }
}
