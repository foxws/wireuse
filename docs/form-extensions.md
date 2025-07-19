---
title: Extending Forms
order: 3
tags:
  - components
  - forms
---

## Introduction

Similar to components, a class and traits are available to extend [Livewire Forms](https://livewire.laravel.com/docs/forms).

## Usage

The `Foxws\WireUse\Forms\Support\Form` class may be used to extend a [Livewire Form](https://livewire.laravel.com/docs/forms):

```php
use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;

class LoginForm extends Form
{
    // Prevent brute force attacks
    protected static int $maxAttempts = 5;

    #[Validate]
    public string $email = '';

    #[Validate]
    public string $password = '';

    #[Validate]
    public bool $remember = false;

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'remember' => 'nullable|boolean',
            'password' => [
                'required',
                Password::defaults(),
            ],
        ];
    }

    /**
     * This method is called after a successful attempt.
     */
    protected function handle(): void
    {
        if (! Auth::attempt($this->only('email', 'password'), $this->remember)) {
            $this->addError('email', __('These credentials do not match our records'));

            return;
        }

        // $this->request(); // return as FormRequest
        // $this->fluent(); // return as Fluent

        session()->regenerate();
    }

    /**
     * This method is called after the handle.
     */
    protected function afterHandle(): mixed
    {
        return redirect()->intended();
    }
}
```

When submitting a form using the `$form->submit()` method, the following steps will be performed:

1. Hit rate-limiter - Only increased when `maxAttempts` has been set to anything above zero (0).
2. Call hook `beforeValidate()`
3. Validate form using `check()` - This may include a reset on validate errors, which is useful on tables or filtering.
4. Call hook `afterValidate()` - Useful to transform values before storing values.
5. Call `store()` - This is used to store the form in current session when `$store` is set to `true`.
6. Call hook `beforeHandle()` - Useful to transform values before given to the handle for processing.
7. Call `handle()` - This should be used for the actually logic.
8. Call hook `afterHandle()` - Useful to redirect users or any other action after processing.

### Concerns

The following is a selection of traits that are available to be used on a Livewire Form:

#### WithAttributes

The `Foxws\WireUse\Forms\Concerns\WithAttributes` trait can be used to retrieve given form attributes using `$form->get(..)`, `$form->has(..)`, `form->contains(..)`, `$form->request()`, `$form->collect()`, `$form->fluent()`, etc.

#### WithSession

The `Foxws\WireUse\Forms\Concerns\WithSession` trait can be used to restore and store form input as session data.

Depending on the use-case, the Livewire [session properties](https://livewire.laravel.com/docs/session-properties) may be used instead.

The main benefits of our trait are that it offers validation recovery, and it can be used to store multiple values at once.

#### WithThrottle

The `Foxws\WireUse\Forms\Concerns\WithThrottle` trait can be used to rate-limit form requests:

```php
use Foxws\WireUse\Forms\Concerns\WithThrottle;

class LoginForm extends Form
{
    use WithThrottle;

    protected static int $maxAttempts = 5;
}
```

#### WithValidation

The `Foxws\WireUse\Forms\Concerns\WithValidation` can be used to validate form requests.

By setting `protected static bool $recoverable = true`, it will try to reset the form on validation errors.

This is useful on dynamic forms, which may change over time.
