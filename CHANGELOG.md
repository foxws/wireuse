# Changelog

All notable changes to `wireuse` will be documented in this file.

## v2.1.1 - 2024-07-16

### What's Changed

* [use LivewireManager for component discovery](https://github.com/foxws/wireuse/commit/d0664901b317e3ab7da556668896b598fa8f73ec)

**Full Changelog**: https://github.com/foxws/wireuse/compare/v2.1.0...v2.1.1

## v2.1.0 - 2024-07-16

### Upgrade Notice

The package `laravel-html:^3.11` has introduced methods we previously provided. You should replace `html()->a()->route('name')` with  `html()->a()->link('name')` if you want to use our route builder logic.

**Full Changelog**: https://github.com/foxws/wireuse/compare/v2.0.2...v2.1.0

## v2.0.2 - 2024-07-13

**Full Changelog**: https://github.com/foxws/wireuse/compare/v2.0.1...v2.0.2

## v2.0.1 - 2024-07-12

### Upgrade Notice

Please `CHANGELOG.md` for the upgrade notice.

**Full Changelog**: https://github.com/foxws/wireuse/compare/v2.0.0...v2.0.1

## v2.0.0 - 2024-07-12

### Upgrade Notice

#### Blade macros aren't enabled by default anymore

Because I want to focus on [laravel-html](https://spatie.be/docs/laravel-html/v3/introduction), you have to register the Blade macros manually using a service provider. Checkout the [documentation](https://foxws.nl/posts/wireuse/blade-macros) for details.

#### Components and controllers have been removed

I don't want to provide any components and controllers anymore. The idea of this package, is to create them yourself.

If you still need them, please checkout the following sources, and re-implement them in your project:

- [https://github.com/foxws/wireuse/tree/v1.0.7/resources](https://github.com/foxws/wireuse/tree/v1.0.7/resources)
- [https://github.com/foxws/wireuse/tree/v1.0.7/src](https://github.com/foxws/wireuse/tree/v1.0.7/src)

#### Actions have been removed

Actions have been removed, because they were too difficult to maintain and not that usable.

If you still need them, please checkout the following sources, and re-implement them in your project:

- [https://github.com/foxws/wireuse/tree/v1.0.7/src/Support/Livewire/ActionObjects](https://github.com/foxws/wireuse/tree/v1.0.7/src/Support/Livewire/ActionObjects)
- [https://github.com/foxws/wireuse/tree/v1.0.7/src/Actions](https://github.com/foxws/wireuse/tree/v1.0.7/src/Actions)
- [https://github.com/foxws/wireuse/blob/c479668d941ab181639309483529022c760e427d/src/WireUseServiceProvider.php#L44](https://github.com/foxws/wireuse/blob/c479668d941ab181639309483529022c760e427d/src/WireUseServiceProvider.php#L44)

### What's Changed

* Bump dependabot/fetch-metadata from 2.1.0 to 2.2.0 by @dependabot in https://github.com/foxws/wireuse/pull/8
* feat: Laravel HTML by @francoism90 in https://github.com/foxws/wireuse/pull/9

**Full Changelog**: https://github.com/foxws/wireuse/compare/v1.0.7...v2.0.0

## v1.0.7 - 2024-06-21

**Full Changelog**: https://github.com/foxws/wireuse/compare/v1.0.6...v1.0.7

## v1.0.6 - 2024-06-20

**Full Changelog**: https://github.com/foxws/wireuse/compare/v1.0.5...v1.0.6

## v1.0.5 - 2024-05-29

### What's Changed

* Allow custom icon class on link
* Add has methods to concerns
* Use `wireKey()` for validation
* Fallback to `name` for `wireKey()`

**Full Changelog**: https://github.com/foxws/wireuse/compare/v1.0.4...v1.0.5

## v1.0.4 - 2024-05-19

### What's Changed

* feat: phpstan by @francoism90 in https://github.com/foxws/wireuse/pull/7

**Full Changelog**: https://github.com/foxws/wireuse/compare/v1.0.3...v1.0.4
