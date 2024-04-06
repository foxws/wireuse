<?php

use Illuminate\Database\Eloquent\Model;

expect()
    ->extend('toBeSameModel', fn (Model $model) => $this->is($model)->toBeTrue());

beforeEach(function () {
    // Fake instances
    \Illuminate\Support\Facades\Bus::fake();
    \Illuminate\Support\Facades\Mail::fake();
    \Illuminate\Support\Facades\Notification::fake();
    \Illuminate\Support\Facades\Queue::fake();
    \Illuminate\Support\Facades\Storage::fake();
});
