<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Setor do usuário') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Definir setor do usuário dentro da empresa. Não é utilizado como permissão.') }}
        </p>
    </header>
    <form method="post" action="{{route('user.group_update', ['id' => $user->id])}}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="grid grid-cols-1 gap-4 py-2 sm:grid-cols-2">
            <div>
                @php
                $cur = $user->find($user->id)->relUserGroup;
                @endphp
                <label for="group" class="block text-sm font-medium text-gray-700">Setor</label>
                <select id="group" name="group" autocomplete="setor"
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option value="{{ $cur->id }}">
                        {{ $cur->name }}</option>
                    @foreach ($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button type="submit">Salvar</x-primary-button>

            @if (session('status') === 'group-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Grupo atualizado com sucesso!') }}</p>
            @endif
        </div>
    </form>

</section>