<div>
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
        <div class="max-w-full p-4 bg-white dark:bg-gray-900">
            <x-title>Cadastrar Status</x-title>
            <form wire:submit.prevent='save'>
                <div class="m-4">
                    <x-input-label for="TicketStatus_name" :value="__('Nome')" />
                    <x-text-input type="text" wire:model.defer='TicketStatus.name' name='TicketStatus_name'
                        id="TicketStatus_name"></x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('TicketStatus.name')" />
                </div>
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    <div class="m-4">
                        <x-input-label for="TicketStatus_description" :value="__('Descrição')" />
                        <x-text-input type="text" wire:model.defer='TicketStatus.description'
                            name='TicketStatus_description' id="TicketStatus_description"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('TicketStatus.description')" />
                    </div>
                    
                </div>
                <div class="m-4">
                    <x-input-label for="TicketStatus_order" :value="__('Ordem de exibição')" />
                    <x-text-input type="number" wire:model.defer='TicketStatus.order' name='TicketStatus_order'
                        class="w-16" id="TicketStatus_order">
                    </x-text-input>
                    <x-input-error class="mt-2" :messages="$errors->get('TicketStatus.order')" />
                </div>
                <div class="m-4">
                    <x-primary-button type="submit">Salvar</x-primary-button>
                </div>
                <div>
                    @if (session()->has('message'))
                    <div class="text-white bg-green-700 alert">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>
            </form>
        </div>
        <div class="max-w-full p-4 bg-white dark:bg-gray-900">
            <x-title>Editar Status</x-title>
            <form wire:submit.prevent='update'>
                <div class="m-4">
                    <x-input-label for="TicketStatus_id" :value="__('Selecionar Status')" />
                    <x-select type="text" wire:model.defer='TicketStatus' name='TicketStatus_id' id="TicketStatus_id">
                        <x-slot name='option'>
                            <option selected>Selecione</option>
                            @foreach($ticketstatuses as $TicketStatus)
                            <x-select.option value="{{$TicketStatus->id}}">
                                {{$TicketStatus->name}}
                            </x-select.option>
                            @endforeach
                        </x-slot>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('TicketStatus.category_id')" />
                </div>
                
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    <div class="m-4">
                        <x-input-label for="TicketStatus_name" :value="__('Nome')" />
                        <x-text-input type="text" wire:model.defer='editingTicketStatus.name' name='TicketStatus_name'
                            id="TicketStatus_name"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('TicketStatus.name')" />
                    </div>
                    <div class="m-4">
                        <x-input-label for="TicketStatus_description" :value="__('Descrição')" />
                        <x-text-input type="text" wire:model.defer='editingTicketStatus.description'
                            name='TicketStatus_description' id="TicketStatus_description"></x-text-input>
                        <x-input-error class="mt-2" :messages="$errors->get('TicketStatus.description')" />
                    </div>
                    
                </div>
                <div class="m-4">
                    <x-primary-button type="submit">Salvar</x-primary-button>
                </div>
                <div>
                    @if (session()->has('update_message'))
                    <div class="text-white bg-green-700 alert">
                        {{ session('update_message') }}
                    </div>
                    @endif
                </div>
            </form>
            
        </div>
    </div>
    <div class="pt-2">
        {{$ticketstatuses->links()}}
        <x-table>
            <x-slot name='head'>
                <x-table.heading>
                    Codigo
                </x-table.heading>
                <x-table.heading>
                    Nome
                </x-table.heading>
                <x-table.heading>
                    Descrição
                </x-table.heading>
            </x-slot>
            <x-slot name='body'>
                @foreach($ticketstatuses as $TicketStatus)
                <x-table.row>
                    <x-table.cell>
                        {{$TicketStatus->id}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$TicketStatus->name}}
                    </x-table.cell>
                    <x-table.cell>
                        {{$TicketStatus->description}}
                    </x-table.cell>
                </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    </div>


<script>
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>

</div>
