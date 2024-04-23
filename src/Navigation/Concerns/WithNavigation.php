<?php

namespace Foxws\WireUse\Navigation\Concerns;

use Foxws\WireUse\Navigation\Support\Navigation;

trait WithNavigation
{
    public Navigation $navigation;

    public function mountWithNavigation(): void
    {
        $this->navigation->fill([
            'schema' => $this->navigation(),
        ]);
    }

    public function navigation(): array
    {
        return [];
    }
}
