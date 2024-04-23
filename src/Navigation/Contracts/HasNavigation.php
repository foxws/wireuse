<?php

namespace Foxws\WireUse\Navigation\Contracts;

use Foxws\WireUse\Navigation\Support\NavigationGroup;

interface HasNavigation
{
    public function navigation(): NavigationGroup;
}
