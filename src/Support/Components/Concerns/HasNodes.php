<?php

namespace Foxws\WireUse\Support\Components\Concerns;

trait HasNodes
{
    public array $nodes = [];

    public function getNodes(): array
    {
        return $this->nodes;
    }

    protected function fillNodes(array $nodes = []): self
    {
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

    protected function getNodeArgs(): array
    {
        return [];
    }
}
