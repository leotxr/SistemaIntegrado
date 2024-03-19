<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Permissões do Usuário') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Definir cargo do usuário para ser utilizado como permissão no sistema.') }}
        </p>
    </header>
    <form method="post" action="/userSetRole/{{ $user->id }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="grid grid-cols-1 gap-4 py-2 sm:grid-cols-2">
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
            <x-primary-button type="submit">Adicionar</x-primary-button>

            @if (session('status') === 'permission-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Permissão atualizada com sucesso!') }}</p>
            @endif
        </div>
    </form>

</section>
