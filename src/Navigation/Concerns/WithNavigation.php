<?php

namespace Foxws\WireUse\Navigation\Concerns;

use Foxws\WireUse\Navigation\Support\Navigation;

trait WithNavigation
{
    public Navigation $navigation;

    public function mountWithNavigation(): void
    {
        $this->navigation->fill([
            'active' => $this->getNavigationModel(),
            'items' => $this->navigation(),
        ]);
    }

    public function updatedWithNavigation(): void
    {
        $this->navigation->fill([
            'active' => $this->getNavigationModel(),
        ]);
    }

    protected function navigation(): array
    {
        return [];
    }

    protected function getNavigationModel(): ?string
    {
        return $this->tab;
    }
}
