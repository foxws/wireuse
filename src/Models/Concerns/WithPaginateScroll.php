<?php

namespace Foxws\WireUse\Models\Concerns;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\WithPagination;

trait WithPaginateScroll
{
    use WithPagination;
    use WithQueryBuilder;
    use WithScroll;

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
