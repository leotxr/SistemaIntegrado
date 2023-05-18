<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Criar Permissão de Usuário') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Crie permissões para determinar o que cada usuário pode fazer. (Exemplo: autorizar pedido, solicitar
            autorizacao, abrir chamado)') }}
        </p>
    </header>

    <form method="post" action="{{route('permission.store')}}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="permission_name" :value="__('Nome da permissão')" />
            <x-text-input id="permission_name" name="permission_name" type="text" class="block w-full mt-1"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'permission-stored')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Registro salvo com sucesso.') }}</p>
            @elseif (session('status') === 'permission-not-stored')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-red-600 dark:text-red-400">{{ __('Ocorreu um erro.') }}</p>
            @endif
        </div>
    </form>
</section>