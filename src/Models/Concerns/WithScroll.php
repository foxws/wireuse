<?php

namespace Foxws\WireUse\Models\Concerns;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

trait WithScroll
{
    #[Locked]
    public Collection $models;

    #[Locked]
    public int $fetchCount = 0;

    public function bootWithScroll(): void
    {
        data_set($this, 'models', Collection::make(), false);
    }

    public function mountWithScroll(): void
    {
        if ($this->models->isEmpty()) {
            $this->fetch();
        }
    }

    #[Computed(persist: true, seconds: 3600)]
    public function items(): Collection
    {
        return $this->models;
    }

    /**
     * This will fetch and merge the items.
     */
    public function fetch(): void
    {
        $items = $this->getMergeCandidates();

        if ($items->isNotEmpty()) {
            $this->mergeScrollItems($items);
        }

        $this->fetchCount++;
    }

    /**
     * This will release the current items cache.
     */
    public function refresh(): void
    {
        unset($this->items);

        $this->dispatch('$refresh');
    }

    /**
     * This should be called to clear the model instances.
     */
    public function clear(): void
    {
        $this->reset('fetchCount');

        $this->resetModels();

        unset($this->items);
    }

    public function isFetchable(): bool
    {
        $fetchLimit = $this->getFetchLimits();

        if ($this->items->isEmpty() || blank($fetchLimit)) {
            return true;
        }

        return $this->fetchCount < $fetchLimit;
    }

    /**
     * This should be called to merge the model instances.
     */
    protected function mergeScrollItems(Collection $items): void
    {
        $this->models = $this->models
            ->mergeRecursive($items)
            ->unique($this->getItemUniqueKey());

        $this->refresh();
    }

    protected function resetModels(): void
    {
        $this->models = Collection::make();
    }

    /**
     * This should return the model instances that will be merged.
     */
    protected function getMergeCandidates(): Collection
    {
        return Collection::make();
    }

    /**
     * This will ensure that the items are unique, to prevent any Livewire key conflicts.
     */
    protected function getItemUniqueKey(): ?string
    {
        return 'id';
    }

    /**
     * This a limit that will used when fetching and merging items.
     */
    protected function getCandidatesLimit(): int
    {
        return 16;
    }

    /**
     * How many times it is possible to call fetch.
     */
    protected function getFetchLimits(): ?int
    {
        return null;
    }
}
