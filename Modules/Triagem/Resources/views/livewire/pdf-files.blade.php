<div>
    <div class="my-2">

        <ol class="items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0">
            <li class="flex items-center text-{{$color}}-600 dark:text-{{$color}}-500 space-x-2.5">
                <span
                    class="flex items-center justify-center w-8 h-8 border border-{{$color}}-600 rounded-full shrink-0 dark:border-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                            clip-rule="evenodd" />
                    </svg>

                </span>
                <span>
                    <h3 wire:click="$set('modalFile', 'true')" class="font-medium leading-tight">{{$title}}</h3>
                    <p wire:loading.remove class="text-sm">{{$description}}</p>
                    <p wire:loading class="text-sm font-bold">Gerando documento...</p>
                </span>

            </li>

        </ol>

    </div>

    {{--MODAL--}}
    <x-modal.confirmation wire:model.defer="modalFile">

        <x-slot name="dialog" class="text-center">
            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                Tem certeza que deseja gerar e assinar este documento?
            </h3>
        </x-slot>
        <x-slot name="buttons">

            <x-secondary-button x-on:click="$dispatch('close')" class="mx-2">Cancelar</x-secondary-button>
            <x-primary-button wire:click="{{$wire_function}}">Assinar</x-primary-button>
        </x-slot>
    </x-modal.confirmation>

</div>