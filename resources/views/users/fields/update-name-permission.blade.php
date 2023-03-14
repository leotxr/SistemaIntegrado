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
            <div class="avatar">
                <div class="w-24 rounded-full active:scale-250">
                    <img src="{{ URL::asset($user->profile_img) }}" />
                </div>
            </div>

        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="lastname" :value="__('Last Name')" />
            <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full" :value="old('lastname', $user->lastname)"
                required autofocus autocomplete="lastname" />
            <x-input-error class="mt-2" :messages="$errors->get('lastname')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <label for="permission" class="block text-sm font-medium text-gray-700">Permissão</label>
            <select id="permission" name="permission" autocomplete="permissão"
                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option value="{{ $user->permissions->pluck('name')->first() }}">
                    {{ $user->permissions->pluck('name')->first() }}</option>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex grid grid-cols-2 sm:grid-cols-2">
            <div>
                <label for="profile_img" class="block text-sm font-medium text-gray-700">Foto de perfil</label>
                <input type="file" id="profile_img" name="profile_img"
                    class="file-input w-full py-2 px-3 max-w-xs" />
            </div>

            <div>
                <label for="signature" class="block text-sm font-medium text-gray-700">Arquivo de Assinatura</label>
                <input type="file" id="signature" name="signature" class="file-input w-full py-2 px-3 max-w-xs" />
            </div>
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button type="submit">Salvar</x-primary-button>
        </div>
    </form>
</section>
