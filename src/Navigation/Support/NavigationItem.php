<?php

namespace Foxws\WireUse\Navigation\Support;

use Foxws\WireUse\Actions\Support\Action;

class NavigationItem extends Action
{
    public function getUrl(): ?string
    {
        if ($this->hasRoute()) {
            return $this->getRoute();
        }

        return $this->getRequestUrl();
    }

    public function isFullUrl(): bool
    {
        return $this->isAppUrl() && request()->fullUrlIs(
            $this->getUrl()
        );
    }

    public function navigable(): bool
    {
        return $this->getWireNavigate() || $this->hasRoute() || $this->isAppUrl();
    }
}
