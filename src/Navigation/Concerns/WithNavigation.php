<?php

namespace Foxws\WireUse\Navigation\Concerns;

use Foxws\WireUse\Navigation\Support\Navigation;

trait WithNavigation
{
    public Navigation $navigation;

    public function mountWithNavigation(): void
    {
        $this->navigation->fill([
            'state' => $this->navigator(),
            'items' => $this->navigation(),
        ]);
    }

    public function updatedWithNavigation(): void
    {
        $this->navigation->fill([
            'state' => $this->navigator(),
        ]);
    }

    protected function navigation(): array
    {
        return [];
    }

    protected function navigator(): ?string
    {
        return null;
    }
}
