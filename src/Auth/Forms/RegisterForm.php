<?php

namespace Foxws\WireUse\Auth\Forms;

use Foxws\WireUse\Forms\Support\Form;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Validate;

class RegisterForm extends Form
{
    protected static int $maxAttempts = 3;

    #[Validate]
    public string $email = '';

    #[Validate]
    public string $password = '';

    #[Validate]
    public string $password_confirmation = '';

    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
            'password_confirmation' => [
                'required',
                Password::defaults(),
            ],
        ];
    }

    protected function handle(): void
    {
        $user = $this->getUserModel()::create(
            $this->getUserData()
        );

        request()->session()->regenerate();

        auth()->login($user);

        event(new Registered($user));
    }

    protected function afterHandle(): mixed
    {
        return redirect()->to('/');
    }

    protected function getUserModel(): User
    {
        return app(config('auth.providers.users.model'));
    }

    protected function getUserData(): array
    {
        $data = $this->only('email', 'password');

        $data['password'] = Hash::make($data['password']);

        return $data;
    }
}
