<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Configurações') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 bg-white justify-items-center sm:grid-cols-6 dark:bg-gray-800">
                <div class="col-span-1 sm:col-span-3">
                    <button class="flex items-center">
                        <x-icon name="key" class="w-12 h-12 text-gray-500"></x-icon>
                        <span class="font-bold text-gray-500">Cargos e Permissões</span>
                    </button>
                </div>
                <div class="col-span-1 sm:col-span-3">
                    Botao
                </div>


            </div>


        </div>
    </div>
</x-app-layout>