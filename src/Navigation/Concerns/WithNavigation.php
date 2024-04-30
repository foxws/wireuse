<?php

namespace Foxws\WireUse\Navigation\Concerns;

use Foxws\WireUse\Support\Components\Concerns\HasNodes;

use function Livewire\store;

trait WithNavigation
{
    use HasNodes;

    public function mountWithNavigation(): void
    {
        $this->fillNodes(
            $this->navigation()
        );
    }

    protected function navigation(): array
    {
        return [];
    }

    protected function getNavigationStore(): mixed
    {
        return store($this);
    }

    protected function getNodeArgs(): array
    {
        return [
            'livewire' => $this,
            'store' => $this->getNavigationStore(),
        ];
    }
}
