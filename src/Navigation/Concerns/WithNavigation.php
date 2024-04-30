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

    public function getCurrentNode(): mixed
    {
        $key = $this->getPropertyValue(
            $this->getNavigationPath()
        );

        return $this->getNode($key);
    }

    public function getNode(string $key): mixed
    {
        return collect($this->getNodes())
            ->first(function (mixed $node) use ($key) {
                if ($node instanceof Action && $node->getName() === $key) {
                    return $node;
                }
            });
    }

    public function getNavigationPath(): string
    {
        return 'tab';
    }

    protected function navigation(): array
    {
        return [];
    }

    protected function getNavigationStore(): mixed
    {
        return store($this);
    }

    protected function validateNode(mixed $node = null): void
    {
        abort_unless($node instanceof Action, 500);
    }

    protected function getNodeArgs(): array
    {
        return [
            'livewire' => $this,
            'store' => $this->getNavigationStore(),
        ];
    }
}
