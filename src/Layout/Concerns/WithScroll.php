<?php

namespace Foxws\WireUse\Layout\Concerns;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Illuminate\Support\Sleep;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\WithPagination;

trait WithScroll
{
    use WithPagination;

    #[Locked]
    public Collection $models;

    public function bootWithScroll(): void
    {
        data_set($this, 'models', collect(), false);
    }

    public function mountWithScroll(): void
    {
        if ($this->items->isEmpty()) {
            // Make sure to be back on the first page
            $this->clear();

            // Fetch the first page
            $this->fetch();
        }
    }

    public function updatingPage(): void
    {
        unset($this->items);
    }

    #[Computed(persist: true, seconds: 3600)]
    public function items(): Collection
    {
        return $this->models;
    }

    public function fetch(): void
    {
        if (! $this->hasMorePages()) {
            return;
        }

        $this->nextPage();

        $this->fillPageItems();
    }

    public function clear(): void
    {
        $this->models = collect();

        unset($this->items);

        $this->resetPage();
    }

    public function hasMorePages(): bool
    {
        return $this->getPageItems()->hasMorePages();
    }

    public function onFirstPage(): bool
    {
        return $this->getPageItems()->onFirstPage();
    }

    public function onLastPage(): bool
    {
        return $this->getPageItems()->onLastPage();
    }

    protected function fillPageItems(): void
    {
        $range = range(1, $this->getScrollLimit());

        foreach ($range as $page) {
            $items = $this->getPageItems($page);

            if ($items->isNotEmpty()) {
                $this->models = $this->models->merge($items->all())->unique('id');

                Sleep::for(100)->milliseconds();
            }
        }
    }

    protected function getPageItems(?int $page = null): Paginator|LengthAwarePaginator
    {
        $page ??= $this->getPage() ?? 1;

        return $this
            ->getQuery()
            ->simplePaginate(perPage: 12, page: $page);
    }

    protected function getScrollLimit(?int $page = null): int
    {
        $page ??= $this->getPage() ?? 1;

        return Number::clamp($page, min: 1, max: 12);
    }
}
