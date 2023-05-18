<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informações do Usuário') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Atualizar nome, e-mail e grupo de permissão do funcionário.') }}
        </p>
    </header>

    <form method="post" action="/users/{{ $user->id }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="lastname" :value="__('Last Name')" />
            <x-text-input id="lastname" name="lastname" type="text" class="block w-full mt-1"
                :value="old('lastname', $user->lastname)" required autofocus autocomplete="lastname" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block w-full mt-1"
                :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button type="submit">Salvar</x-primary-button>
        </div>
    </form>
</section>