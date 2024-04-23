<?php

namespace Foxws\WireUse\Navigation\Concerns;

use Foxws\WireUse\Navigation\Support\NavigationGroup;

trait WithNavigation
{
    public function navigation(): NavigationGroup
    {
        return NavigationGroup::make();
    }
}
