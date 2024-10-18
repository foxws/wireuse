<?php

namespace Foxws\WireUse\Layout\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Laravel\Scout\Scout;
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
        throw_if(
            ! method_exists($this, 'getBuilder') ||
            ! ($this->getBuilder() instanceof Builder || ! $this->getBuilder() instanceof Scout)
        );

        data_set($this, 'models', collect(), false);
    }

    public function mountWithScroll(): void
    {
        if ($this->models->isEmpty()) {
            $this->fillScrollItems();
        }
    }

    #[Computed(persist: true, seconds: 3600)]
    public function items(): Collection
    {
        return $this->models;
    }

    public function fetch(): void
    {
        $page = $this->getScrollPage();

        $limit = $this->getScrollPageLimit();

        if (! $this->hasMorePages() || (is_numeric($limit) && $page > $limit)) {
            return;
        }

        $this->nextPage(pageName: $this->getScrollPageName());

        $this->fillPageScrollItems();
    }

    public function clear(): void
    {
        $this->models = collect();

        unset($this->items);

        $this->resetPage();
    }

    public function getScrollPage(): ?int
    {
        return $this->getPage(pageName: $this->getScrollPageName());
    }

    public function hasMorePages(): bool
    {
        return $this->getScrollBuilder()->hasMorePages();
    }

    public function onFirstPage(): bool
    {
        return $this->getScrollBuilder()->onFirstPage();
    }

    public function onLastPage(): bool
    {
        return $this->getScrollBuilder()->onLastPage();
    }

    protected function fillPageScrollItems(): void
    {
        $items = $this->getScrollBuilder()->getCollection();

        $this->mergeScrollItems($items);
    }

    protected function fillScrollItems(?int $page = null): void
    {
        $builder = $this->getScrollBuilder();

        $pages = $this->getScrollPages($page);

        $limit = $this->getScrollPageLimit();

        $pages->each(function (int $page) use ($builder, $limit) {
            if (! $this->hasMorePages() || (is_numeric($limit) && $page > $limit)) {
                return false;
            }

            $this->mergeScrollItems(
                $builder->getCollection()
            );

            $this->nextPage(pageName: $this->getScrollPageName());
        });
    }

    protected function mergeScrollItems(Collection $items): void
    {
        $this->models = $this->models
            ->merge($items->filter()->all())
            ->unique($this->getScrollPageUniqueKey());

        unset($this->items);
    }

    protected function getScrollBuilder(): Paginator
    {
        $perPage = $this->getScrollPerPage();

        return $this->getBuilder()->simplePaginate(perPage: $perPage);
    }

    protected function getScrollPages(?int $page = null): Collection
    {
        $page ??= $this->getScrollPage();

        return collect(range(1, $page ?? 1));
    }

    protected function getScrollPerPage(): int
    {
        return 16;
    }

    protected function getScrollPageLimit(): ?int
    {
        return null;
    }

    protected function getScrollPageUniqueKey(): ?string
    {
        return 'id';
    }

    protected function getScrollPageName(): string
    {
        return 'page';
    }
}
