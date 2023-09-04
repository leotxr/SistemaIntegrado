<div>
    <div>
        <div class="grid justify-end text-end">
            <div>
                <x-primary-button wire:click="openModalBudget">
                    <x-icon name="plus" class="w-4 h-4 text-white" /> Novo Orçamento
                </x-primary-button>
            </div>
        </div>
        <div class="mt-4">
            <x-table>
                <x-slot name="head">
                    <x-table.heading>
                        Data
                    </x-table.heading>
                    <x-table.heading>
                        Paciente
                    </x-table.heading>
                    <x-table.heading>
                        Telefone
                    </x-table.heading>
                    <x-table.heading>
                        Valor
                    </x-table.heading>
                    <x-table.heading>
                        Status
                    </x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach($orcamentos as $orcamento)
                    <x-table.row class="cursor-pointer hover:bg-gray-100"
                        wire:click='openModalDetails({{$orcamento->id}})'>
                        <x-table.cell>
                            {{date('d/m/Y H:i:s', strtotime($orcamento->created_at))}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$orcamento->patient_name}}
                        </x-table.cell>
                        <x-table.cell>
                            {{$orcamento->patient_phone}}
                        </x-table.cell>
                        <x-table.cell>
                            R$ {{$orcamento->total_value}}
                        </x-table.cell>
                        <x-table.cell>
                            @if($orcamento->scheduled === 1)
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Agendado</span>
                            @else
                            <span
                                class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300">Não
                                Agendado</span>
                            @endif
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
            {{$orcamentos->links()}}
        </div>
    </div>

    <x-modal wire:model.defer='modalBudget' maxWidth='5xl'>
        @livewire('orcamento::budget.create-budget-form')
    </x-modal>

    @isset($showing)
    <x-modal wire:model.defer='modalDetails' maxWidth='5xl'>
        @livewire('orcamento::budget.budget-details', ['orcamento' => $showing], key($showing->id))
    </x-modal>
    @endisset

</div>