<?php

namespace Foxws\WireUse\Support\Components\Concerns;

use Foxws\WireUse\Actions\Support\Action;

trait HasNodes
{
    public array $nodes = [];

    public function getNodes(): array
    {
        return $this->nodes;
    }

    public function fillNodes(array $nodes = []): self
    {
        $this->validateNodes($nodes);

        $this->nodes = $nodes;

        return $this;
    }

    protected function addNode(mixed $node = null): self
    {
        $this->nodes[] = value($node, $this->getNodeArgs());

        return $this;
    }

    protected function addNodeIf(mixed $condition, mixed $node = null): self
    {
        if (value($condition)) {
            $this->addNode($node);
        }

        return $this;
    }

    protected function validateNodes(array $nodes = []): void
    {
        collect($nodes)
            ->each(fn (mixed $node) => abort_if(! $node instanceof Action, 500));
    }

    protected function getNodeArgs(): array
    {
        return [];
    }
}
