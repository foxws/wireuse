---
title: Infinite Scroll
order: 6
tags:
  - components
  - blade
  - views
---

## Introduction

Infinite scrolling is an approach which loads content continuously as the user scrolls down or on button click.

While many tutorials increase the query limit (`->take()`), this trait focuses on fetching as paginate.

This should decrease database load, and make fetching while merging items a lot more efficient.

## Usage

> Tip: Optionally you may want to include `Livewire\WithoutUrlPagination` to hide `?page=` args.

To use infinite scrolling, implement the `WithPaginateScroll` trait on a Livewire component:

```php
use Domain\Tags\Models\Tag;
use Foxws\WireUse\Models\Concerns\WithPaginateScroll;
use Illuminate\Pagination\Paginator;
use Livewire\Component;

class Section extends Component
{
    use WithPaginateScroll;

    /**
     * This builds upon the WithQueryBuilder trait.
     */
    protected function getBuilder(): Paginator
    {
        return $this->getQuery()
            ->where('state', 'published')
            ->simplePaginate(
                perPage: $this->getCandidatesLimit(),
                page: $this->getPage(),
            );
    }

    /**
     * Defines the model class used to call the query builder.
     */
    protected function getModelClass(): ?string
    {
        return Tag::class;
    }

    /**
     * This a limit that will used when fetching and merging items.
     */
    protected function getCandidatesLimit(): int
    {
        return 12;
    }

    /**
     * How many times it is possible to call fetch.
     */
    protected function getFetchLimits(): ?int
    {
        return 3; // total items 12 * 3 = 36
    }
}
```

Create a Blade view (e.g. `tags.blade.php`):

```blade
<div>
    <div
        wire:scroll
        wire:poll.900s
        class="grid grid-cols-2 overflow-y-scroll"
    >
        @foreach ($this->items as $tag)
            <div wire:key="{{ $tag->getRouteKey() }}">
                <livewire:tags.item :$tag :key="$tag->getRouteKey()" />
            </div>
        @endforeach
    </div>

    <nav class="flex items-center w-full">
        @if ($this->isFetchable())
            <button
                wire:loading.attr="disabled"
                wire:click="nextPage"
            >
                Load more
            </button>
        @endif
    </nav>
</div>
```

It is also possible to use an 'on-scroll' approach using an Alpine intersect:

```blade
<div x-data>
    <div
        wire:poll.900s
        class="grid grid-cols-2 overflow-y-scroll"
    >
        @foreach ($this->items as $tag)
            <div wire:key="{{ $tag->getRouteKey() }}">
                <livewire:tags.item :$tag :key="$tag->getRouteKey()" />
            </div>
        @endforeach
    </div>

    <div
        class="w-full h-0 min-h-0"
        x-intersect.full="$wire.nextPage()"
    />
</div>
```
