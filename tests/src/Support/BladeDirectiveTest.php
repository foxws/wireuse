<?php

use Foxws\WireUse\Tests\TestCase;
use Illuminate\Support\Facades\Blade;

uses(TestCase::class);

it('provides a blade directive to merge classes', function () {
    expect(Blade::render('<x-test-component />'))
        ->toContain('class="flex flex-nowrap bg-gray-300 opacity-50"')
        ->toMatchSnapshot();
});
