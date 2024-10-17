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
            $this->fillPageItems();
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

        $this->fillCurrentPageItems();
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
        $range = range(1, $this->getPageFillLimit());

        foreach ($range as $page) {
            $items = $this->getPageItems($page);

            $this->mergePageItems($items);

            Sleep::for(100)->milliseconds();
        }
    }

    protected function fillCurrentPageItems(): void
    {
        $items = $this->getPageItems();

        $this->mergePageItems($items);
    }

    protected function mergePageItems(Paginator|Collection $items): void
    {
        if ($items->isEmpty()) {
            return;
        }

        $this->models = $this->models
            ->merge($items->filter()->all())
            ->unique($this->getPageItemKey());
    }

    protected function getPageItems(?int $page = null): Paginator|LengthAwarePaginator
    {
        $page ??= $this->getPage() ?? 1;

        return $this
            ->getQuery()
            ->simplePaginate(perPage: 16, page: $page);
    }

    protected function getPageFillLimit(?int $page = null): int
    {
        $page ??= $this->getPage() ?? 1;

        return Number::clamp($page, min: 1, max: 12);
    }

    protected function getPageItemKey(): ?string
    {
        return 'id';
    }
}
