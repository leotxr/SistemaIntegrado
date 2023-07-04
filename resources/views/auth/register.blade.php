<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                    autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="lastname" :value="__('Sobrenome')" />
                <x-text-input id="lastname" class="block w-full mt-1" type="text" name="lastname"
                    :value="old('lastname')" required autofocus />
                <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
            <!-- Username -->
            <div class="mt-4">
                <x-input-label for="username" :value="__('Usuario')" />
                <x-text-input id="username" class="block w-full mt-1" type="text" name="username"
                    :value="old('username')" required />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="user_group_id" :value="__('Setor')" class="text-lg font-bold" />
                <x-select name='user_group_id' id="user_group_id" class="w-full">
                    <x-slot name='option'>
                        <option selected> Selecione </option>
                        @foreach($groups as $group)
                        <x-select.option value="{{$group->id}}">
                            {{$group->name}}
                        </x-select.option>
                        @endforeach
                    </x-slot>
                </x-select>
                <x-input-error class="mt-2" :messages="$errors->get('group')" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                name="password_confirmation" required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="text-sm underline rounded-md text-gray-50 dark:text-gray-50 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>