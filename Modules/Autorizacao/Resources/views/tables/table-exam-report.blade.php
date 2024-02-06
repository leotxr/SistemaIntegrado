<div>
    <div>
        <div class="m-2">
            <x-text-input type="text" wire:model='search' placeholder="Buscar solicitações...">
            </x-text-input>
            <x-input-error class="mt-2" :messages="$errors->get('exam.exam')"/>
        </div>
    </div>
    <x-table>
        <x-slot name="head">
            <x-table.heading sortable wire:click="sortBy('protocols.created_at')"
                             :direction="$sortField === 'protocols.created_at' ? $sortDirection : null">Data
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('protocols.id')"
                             :direction="$sortField === 'protocols.id' ? $sortDirection : null">Código
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('protocols.paciente_name')"
                             :direction="$sortField === 'protocols.paciente_name' ? $sortDirection : null">Paciente
            </x-table.heading>
            <x-table.heading>Exame
            </x-table.heading>
            <x-table.heading>Convênio
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('protocols.created_by')"
                             :direction="$sortField === 'protocols.created_by' ? $sortDirection : null">Solicitante
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('protocols.updated_by')"
                             :direction="$sortField === 'protocols.updated_by' ? $sortDirection : null">Último Usuário
            </x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading>Ações</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach($protocols as $protocol)
                @php
                    $exams = $protocol->find($protocol->id)->exams;
                    $requester = $protocol->find($protocol->id)->requester;
                    $last_user = $protocol->find($protocol->id)->updater;
                @endphp
                @foreach($exams->whereIn('exam_status_id', $activeStatus) as $exam)
                    <x-table.row>
                        <x-table.cell>{{$protocol->created_at}}</x-table.cell>
                        <x-table.cell>{{$protocol->id}}</x-table.cell>
                        <x-table.cell>{{$protocol->paciente_name}}</x-table.cell>
                        <x-table.cell>{{$exam->name}}</x-table.cell>
                        <x-table.cell>{{$exam->convenio}}</x-table.cell>
                        <x-table.cell>{{$requester->name}}</x-table.cell>
                        <x-table.cell>{{$last_user->name}}</x-table.cell>
                        <x-table.cell>{{$exam->examStatus->name}}</x-table.cell>
                        <x-table.cell>
                            <button wire:click="$emit('editRequest', {{$exam->protocol_id}})"
                                    class="text-blue-800 font-bold inline-flex"
                                    type="submit">
                                <x-icon name="pencil-alt" class="w-6 h-6"></x-icon>
                                Editar
                            </button>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            @endforeach
        </x-slot>
    </x-table>
</div>
