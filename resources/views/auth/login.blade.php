<x-wireui::layout-container class="flex h-screen flex-col items-center justify-center gap-y-6">
    <x-wireui::ui-card class="shadow-sm sm:max-w-lg sm:rounded-xl bg-gray-900">
        <x-wireui::forms-schema>
            <x-wireui::layout-join class="gap-y-2" vertical>
                <x-wireui::forms-label for="form.email">
                    {{ __('Email') }}
                </x-wireui::forms-label>

                <x-wireui::forms-input
                    wire:model="form.email"
                    type="email"
                    class="border-0 bg-gray-800 text-gray-300 placeholder:text-gray-500"
                    placeholder="{{ __('Your Email') }}"
                    autocomplete="email"
                    autofocus
                    required
                />
            </x-wireui::layout-join>

            <x-wireui::layout-join class="gap-y-2" vertical>
                <x-wireui::forms-label for="form.password">
                    {{ __('Password') }}
                </x-wireui::forms-label>

                <x-wireui::forms-input
                    wire:model="form.password"
                    type="password"
                    class="border-0 bg-gray-800 text-gray-300 placeholder:text-gray-500"
                    placeholder="{{ __('Your Password') }}"
                    autocomplete="current-password"
                    required
                />
            </x-wireui::layout-join>

            <x-wireui::layout-join class="gap-x-2">
                <x-wireui::forms-checkbox
                    wire:model="form.remember"
                />

                <x-wireui::forms-label for="form.remember">
                    {{ __('Remember me') }}
                </x-wireui::forms-label>
        </x-wireui::layout-join>

            <x-wireui::actions-button
                class="py-1.5 font-medium bg-primary-500"
                type="submit"
            >
                {{ __('Sign In') }}
            </x-wireui::actions-button>
        </x-wireui::forms-schema>
    </x-wireui::ui-card>
</x-wireui::layout-container>
