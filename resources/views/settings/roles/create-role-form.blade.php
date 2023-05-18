<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Criar Cargo de Usuário') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Crie cargos para determinar os setores em que os usuários trabalham. (Exemplo: recepcao, ti, administrativo)') }}
        </p>
    </header>

    <form method="post" action="{{route('role.store')}}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="role_name" :value="__('Nome do cargo')" />
            <x-text-input id="role_name" name="role_name" type="text" class="block w-full mt-1" autocomplete="new-role" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>
        
       

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'role-stored')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Registro salvo com sucesso.') }}</p>
            @endif
        </div>
    </form>
</section>
