<?php

use Foxws\WireUse\Support\Livewire\LegacyModels\EloquentCollectionSynth;
use Foxws\WireUse\Support\Livewire\LegacyModels\EloquentModelSynth;
use Foxws\WireUse\Support\Livewire\Models\CollectionSynth;
use Foxws\WireUse\Support\Livewire\Models\ModelSynth;
use Foxws\WireUse\Tests\Models\Post;
use Foxws\WireUse\Tests\TestCase;
use Foxws\WireUse\Tests\TestClasses\LivewireCollectionComponent;
use Foxws\WireUse\Tests\TestClasses\LivewireModelComponent;
use Livewire\Livewire;

uses(TestCase::class);

beforeEach(function () {
    Livewire::propertySynthesizer([
        ModelSynth::class,
        CollectionSynth::class,
        EloquentModelSynth::class,
        EloquentCollectionSynth::class,
    ]);
});

it('can load model with synthesizers', function () {
    $post = Post::factory()->create();

    Livewire::test(LivewireModelComponent::class, compact('post'))
        ->assertStatus(200);
});

it('can load models with synthesizers', function () {
    $posts = Post::factory()->count(3)->create();

    Livewire::test(LivewireCollectionComponent::class, compact('posts'))
        ->assertStatus(200);
});
