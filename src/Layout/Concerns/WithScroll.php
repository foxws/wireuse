<?php

namespace Foxws\WireUse\Layout\Concerns;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Number;
use Illuminate\Support\Sleep;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\WithPagination;

trait WithScroll
{
    use WithPagination;

    #[Locked]
    public array $models = [];

    public function mountWithScroll(): void
    {
        if (blank($this->models)) {
            $range = range(1, $this->getScrollLimit());

            foreach ($range as $page) {
                $this->mergePageItems($this->getPageItems($page)->all());

                Sleep::for(100)->milliseconds();
            }
        }
    }

    #[Computed]
    public function items(): array
    {
        return $this->models;
    }

    public function fetch(): void
    {
        $this->nextPage();

        $this->mergePageItems(
            $this->getPageItems()->all()
        );
    }

    public function clear(): void
    {
        $this->reset('models');

        unset($this->items);

        $this->resetPage();
    }

    protected function getPageItems(?int $page = null): LengthAwarePaginator
    {
        $page ??= $this->getPage();

        return $this->getQuery()
            ->paginate(perPage: 16, page: $page);
    }

    protected function mergePageItems(array $models = []): void
    {
        $this->models = array_merge_recursive($this->models, $models);
    }

    protected function getScrollLimit(?int $page = null): int
    {
        $page ??= $this->getPage() ?? 1;

        return Number::clamp($page, 1, 32);
    }
}
