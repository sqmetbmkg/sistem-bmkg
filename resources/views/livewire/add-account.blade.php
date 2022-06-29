<x-jet-form-section submit="addAccount">
    <x-slot name="title">
        {{ __('Add Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('To Add New Account') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="username" value="{{ __('Username') }}" />
            <x-jet-input class="w-full" type="text" wire:model="username" id="username" />
            <x-jet-input-error for="username" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Complete Station Name') }}" />
            <x-jet-input class="w-full" type="text" wire:model="name" id="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="{{ __('Password') }}" />
            <x-jet-input class="w-full" type="password" wire:model="password" id="password" />
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password_confirmation" value="{{ __('Repeat Password') }}" />
            <x-jet-input class="w-full" type="password" wire:model="repeatPassword" id="repeat-password" />
            <x-jet-input-error for="repeatPassword" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="password">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>