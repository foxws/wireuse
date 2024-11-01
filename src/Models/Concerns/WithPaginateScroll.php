<?php

namespace Foxws\WireUse\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Laravel\Scout\Scout;
use Livewire\WithPagination;

trait WithPaginateScroll
{
    use WithPagination;
    use WithQueryBuilder;
    use WithScroll;

    public function bootWithPaginateScroll(): void
    {
        throw_if(
            ! method_exists($this, 'getBuilder') ||
            ! ($this->getBuilder() instanceof Builder || ! $this->getBuilder() instanceof Scout)
        );
    }

    public function updatedPage(): void
    {
        $this->fetch();
    }

    public function isFetchable(): bool
    {
        if ($this->items->isEmpty()) {
            return true;
        }

        return $this->getBuilder()->hasMorePages();
    }

    public function clear(): void
    {
        $this->reset('fetchCount');

        $this->resetPage();

        $this->models = collect();

        unset($this->items);
    }

    protected function getMergeCandidates(): Collection
    {
        return $this->getBuilder()->getCollection();
    }

    protected function getBuilder(): Paginator
    {
        return $this->getQuery()
            ->simplePaginate(
                perPage: $this->getCandidatesLimit(),
                page: $this->getPage(),
            );
    }
}
