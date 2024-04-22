<x-wireui::layout-container class="flex flex-col gap-y-6 h-screen items-center justify-center">
    <x-wireui::ui-card class="shadow-sm sm:max-w-lg sm:rounded-xl bg-gray-900">
        <x-wireui::forms-schema>
            <x-wireui::forms-input
                wire:model="form.email"
                type="email"
                label="{{ __('Email') }}"
                required
                autofocus
            />

            <x-wireui::forms-input
                wire:model="form.password"
                type="password"
                label="{{ __('Password') }}"
                required
            />

            <x-wireui::forms-input
                wire:model="form.password_confirmation"
                type="password"
                label="{{ __('Confirm Password') }}"
                required
            />

            <x-wireui::actions-button
                class="btn-primary"
                type="submit"
            >
                {{ __('Sign Up') }}
            </x-wireui::actions-button>
        </x-wireui::forms-schema>
    </x-wireui::ui-card>
</x-wireui::layout-container>
