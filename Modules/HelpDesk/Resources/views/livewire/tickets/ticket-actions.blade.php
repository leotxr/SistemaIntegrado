<div class="flex justify-end my-2 rounded-lg shadow-md ">
    <div class="mx-4 my-2 dropdown dropdown-down dropdown-end">
        <ul tabindex="0"
            class="p-2 shadow dropdown-content menu bg-base-100 dark:bg-gray-600 dark:text-gray-50 rounded-box w-52">
            @if($ticket->status_id === 4)
                <li><a wire:click='callPause({{$ticket->id}})'>
                        <x-icon name="pause" class="w-4 h-4"/>
                        Pausar
                    </a></li>
                <li><a wire:click='callTransfer({{$ticket->id}})'>
                        <x-icon name="switch-horizontal" class="w-4 h-4"/>
                        Transferir
                    </a></li>
            @endif
            <li><a class="disabled">
                    <x-icon name="link" class="w-4 h-4"/>
                    Mesclar
                </a></li>
            <li><a wire:click="callEdit({{$ticket->id}})">
                    <x-icon name="pencil" class="w-4 h-4"/>
                    Editar
                </a></li>
            <li><a wire:click='callDelete({{$ticket->id}})'>
                    <x-icon name="trash" class="w-4 h-4"/>
                    Excluir
                </a></li>
        </ul>
        <button tabindex="0">
            <x-icon name="menu" class="w-8 h-8 dark:text-gray-50"/>
        </button>
    </div>
    <div class="my-2">
        @if($ticket->status_id === 1)
            <x-primary-button class="mx-2 bg-blue-800" wire:click="$emit('TicketStart', {{$ticket->id}})">Atender
            </x-primary-button>
        @endif
        @if($ticket->status_id === 4)
            <x-primary-button class="mx-2 bg-blue-600 hover:bg-blue-400" wire:click='callFinish({{$ticket->id}})'>
                Finalizar
            </x-primary-button>
        @endif
        @if($ticket->status_id === 2)
            <x-secondary-button class="mx-2" wire:click='callReopen({{$ticket->id}})'>Reabrir</x-secondary-button>
        @endif
        @if($ticket->status_id === 3)
            <x-secondary-button class="mx-2" wire:click='callEndPause({{$ticket->id}})'>Retomar Atendimento
            </x-secondary-button>
        @endif
    </div>
</div>