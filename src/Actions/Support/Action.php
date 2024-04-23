<?php

namespace Foxws\WireUse\Actions\Support;

use Foxws\WireUse\Actions\Concerns\HasComponents;
use Foxws\WireUse\Actions\Concerns\HasIcon;
use Foxws\WireUse\Actions\Concerns\HasLivewire;
use Foxws\WireUse\Actions\Concerns\HasName;
use Foxws\WireUse\Actions\Concerns\HasRequest;
use Foxws\WireUse\Actions\Concerns\HasRoute;
use Foxws\WireUse\Actions\Concerns\HasState;
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
    use HasState;
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

    public function getIcon(): ?string
    {
        return $this->when($this->getActive(),
            fn () => $this->getActiveIcon(),
            fn () => $this->getIcon(),
        );
    }

    public function getActive(): bool
    {
        return $this->isActive() || $this->isRoute();
    }

    public function getWireNavigate(): bool
    {
        return $this->shouldNavigate() || $this->hasRoute() || $this->isAppUrl();
    }
}
