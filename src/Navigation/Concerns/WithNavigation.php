<?php

namespace Foxws\WireUse\Navigation\Concerns;

use Foxws\WireUse\Navigation\Support\Navigation;

trait WithNavigation
{
    public Navigation $navigation;

    public function mountWithNavigation(): void
    {
        $this->syncNavigation();
    }

    public function updatedWithNavigation(): void
    {
        $this->syncNavigation();
    }

    protected function syncNavigation(): void
    {
        $this->navigation->fill([
            'state' => $this->navigator(),
            'items' => $this->navigation(),
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
