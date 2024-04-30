<?php

namespace Foxws\WireUse\Navigation\Concerns;

use Foxws\WireUse\Actions\Support\Action;
use Foxws\WireUse\Support\Components\Concerns\HasNodes;

use function Livewire\store;

trait WithNavigation
{
    use HasNodes;

    public function bootedWithNavigation(): void
    {
        $this->fillNodes($this->navigation());
    }

    protected function navigation(): array
    {
        return [];
    }

    protected function getNavigation(string $key): mixed
    {
        return collect($this->getNodes())
            ->first(function (mixed $node) use ($key) {
                if ($node instanceof Action && $node->getName() === $key) {
                    return $node;
                }
            });
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
