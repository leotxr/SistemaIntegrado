<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __("Permissões de $user->name") }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Permissões autorizadas ao cargo do usuário.') }}
        </p>
    </header>

    <div class="">
        @livewire('users.permissions.show-user-permissions', ['user' => $user])
    </div>

</section>
