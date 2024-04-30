<?php

namespace Foxws\WireUse\Navigation\Concerns;

use Foxws\WireUse\Actions\Support\Action;

trait WithTabs
{
    public function currentTab(): mixed
    {
        $key = $this->getPropertyValue(
            $this->getTabPath()
        );

        return $this->filterTabs($key)->first();
    }

    public function getTabPath(): string
    {
        return 'tab';
    }

    protected function tabs(): array
    {
        return [];
    }

    protected function filterTabs(string $key): mixed
    {
        return collect($this->tabs())
            ->where(function (mixed $item) use ($key) {
                if ($item instanceof Action && $item->getName() === $key) {
                    return $item;
                }
            });
    }
}
