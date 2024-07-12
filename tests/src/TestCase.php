<?php

namespace Foxws\WireUse\Tests;

use Foxws\WireUse\Tests\TestClasses\BladeComponent;
use Foxws\WireUse\Tests\TestClasses\LivewireCollectionComponent;
use Foxws\WireUse\Tests\TestClasses\LivewireModelComponent;
use Foxws\WireUse\WireUseServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    use WithWorkbench;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
        $this->setUpComponents($this->app);
        $this->setUpLivewire($this->app);
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('cache.default', 'file');

        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('view.paths', [__DIR__.'/../resources/views']);
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            WireUseServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpDatabase($app)
    {
        Schema::dropAllTables();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('title');
            $table->text('content')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpComponents($app)
    {
        Blade::component('test-component', BladeComponent::class);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function setUpLivewire($app)
    {
        Livewire::component('test-collection', LivewireCollectionComponent::class);
        Livewire::component('test-model', LivewireModelComponent::class);
    }
}
