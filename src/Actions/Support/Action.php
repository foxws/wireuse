<?php

namespace Foxws\WireUse\Actions\Support;

use Foxws\WireUse\Actions\Concerns\HasComponents;
use Foxws\WireUse\Actions\Concerns\HasIcon;
use Foxws\WireUse\Actions\Concerns\HasLivewire;
use Foxws\WireUse\Actions\Concerns\HasName;
use Foxws\WireUse\Actions\Concerns\HasRequest;
use Foxws\WireUse\Actions\Concerns\HasRoute;
use Foxws\WireUse\Actions\Concerns\HasView;
use Foxws\WireUse\Support\Components\Component;

class Action extends Component
{
    use HasComponents;
    use HasIcon;
    use HasLivewire;
    use HasName;
    use HasRequest;
    use HasRoute;
    use HasView;

    public static function make(): static
    {
        return app(static::class);
    }

    public function getUrl(): ?string
    {
        if ($this->hasRoute()) {
            return $this->getRoute();
        }

        return $this->getRequestUrl();
    }

    public function isActive(): bool
    {
        return $this->isRoute() || $this->isFullUrl();
    }

    public function isFullUrl(): bool
    {
        return $this->isAppUrl() && request()->fullUrlIs(
            $this->getUrl()
        );
    }

    public function shouldNavigate(): bool
    {
        return $this->value('navigate', $this->hasRoute() || $this->isAppUrl());
    }
}
