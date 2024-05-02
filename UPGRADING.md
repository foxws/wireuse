# Upgrading

Because there are many breaking changes an upgrade is not that easy. There are many edge cases this guide does not cover. We accept PRs to improve this guide.

## From v0 to v1

- It now includes a basic set of components. It can optionally be disabled in `config/wireuse.php`.
- The `classFor` behavior has been changed. You now need to specify the class attribute: `<label class="{{ $attributes->classFor('label') }}" />`.
- The `spatie/laravel-model-states` package is now not registered by default. You now need to register `ModelStateObjectSynth::class` manually in a `Service Provider`.
