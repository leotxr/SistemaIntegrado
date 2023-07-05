<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Permissões do Usuário') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Atualizar nome, e-mail e grupo de permissão do funcionário.') }}
        </p>
    </header>
    <form method="post" action="/userSetRole/{{ $user->id }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="grid grid-cols-1 gap-4 py-2 sm:grid-cols-2">

            {{--
            <div>
                <label for="permission" class="block text-sm font-medium text-gray-700">Permissão</label>
                <select id="permission" name="permission" autocomplete="permissão"
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option value="{{ $user->permissions->pluck('name')->first() }}">
                        {{ $user->permissions->pluck('name')->first() }}</option>
                    @foreach ($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>
            --}}
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Cargo/Setor</label>
                <select id="role" name="role" autocomplete="cargo"
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option value="{{ $user->roles->pluck('name')->first() }}">
                        {{ $user->roles->pluck('name')->first() }}</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button type="submit">Salvar</x-primary-button>

            @if (session('status') === 'permission-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

</section>