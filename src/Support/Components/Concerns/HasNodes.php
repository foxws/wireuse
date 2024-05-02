<?php

namespace Foxws\WireUse\Support\Components\Concerns;

use Livewire\Attributes\Locked;

trait HasNodes
{
    #[Locked]
    public array $nodes = [];

    public function getNodes(): array
    {
        return $this->nodes;
    }

    public function getNode(string $key): mixed
    {
        return null;
    }

    public function fillNodes(array $nodes = []): self
    {
        $this->validateNodes($nodes);

        $this->nodes = $nodes;

        return $this;
    }

    public function addNode(mixed $node = null): self
    {
        $this->validateNode($node);

        $this->nodes[] = value($node, $this->getNodeArgs());

        return $this;
    }

    protected function validateNode(mixed $node = null): void
    {
        //
    }

    protected function validateNodes(array $nodes = []): void
    {
        collect($nodes)
            ->each(fn (mixed $node) => $this->validateNode($node));
    }

    protected function getNodeArgs(): array
    {
        return [];
    }
}
