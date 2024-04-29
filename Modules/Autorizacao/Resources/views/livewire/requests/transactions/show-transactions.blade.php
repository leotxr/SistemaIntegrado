<div>
    <x-modal.dialog wire:model.defer="modalTransactions">
        <x-slot:title>Transações do Exame</x-slot:title>
        <x-slot:content>
            @isset($exam)
                <div x-data="{formEvent: false}">
                    <div>

                        {{$exam->id}}
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading>Data</x-table.heading>
                                <x-table.heading>Evento</x-table.heading>
                                <x-table.heading>Usuário</x-table.heading>
                            </x-slot>
                            <x-slot name="body">
                                @foreach($exam->transactions as $transaction)
                                    @php
                                        $event = $transaction->ExamEvent;
                                    @endphp
                                    <x-table.row>
                                        <x-table.cell>{{$transaction->created_at}}</x-table.cell>
                                        <x-table.cell>{{$event->name}}</x-table.cell>
                                        <x-table.cell>{{$transaction->User->name}}</x-table.cell>
                                    </x-table.row>
                                @endforeach
                            </x-slot>
                        </x-table>

                    </div>
                    <div>
                        <div class="w-full grid justify-items-end p-2">
                            <a type="button" class="inline-flex items-center cursor-pointer"
                               x-on:click="formEvent = ! formEvent" wire:click="$emit('openNewEvent', {{$exam->id}})">
                                <div
                                    :class="formEvent ? 'rotate-45 transition transform duration-300 text-red-600' : 'transition transform duration-300 text-green-600'">
                                    <x-icon name="plus" class="w-6 h-6 "></x-icon>
                                </div>
                                <span> Novo evento</span> </a>
                        </div>
                    </div>
                    <div>

                        @livewire('autorizacao::requests.transactions.new-transaction', ['exam_id' => $exam->id])
                    </div>
                </div>
            @endisset
        </x-slot:content>
        <x-slot:footer>
            <div class="space-x-2">
                <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
            </div>
        </x-slot:footer>
    </x-modal.dialog>
</div>
