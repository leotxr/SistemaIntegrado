<div class="space-y-4">

    <div>
        <div class="mt-4">
            <x-text-input type="text" wire:model='search' placeholder="Buscar solicitações...">
            </x-text-input>
            <x-input-error class="mt-2" :messages="$errors->get('exam.exam')"/>
        </div>
    </div>
    {{$selectedStatus->links()}}
    <x-table>
        <x-slot name="head">
            <x-table.heading sortable wire:click="sortBy('exams.exam_date')"
                             :direction="$sortField === 'exams.exam_date' ? $sortDirection : null">Data
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('protocols.paciente_name')"
                             :direction="$sortField === 'protocols.paciente_name' ? $sortDirection : null">Nome
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('exams.name')"
                             :direction="$sortField === 'exams.name' ? $sortDirection : null">Exame
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('exams.convenio')"
                             :direction="$sortField === 'exams.convenio' ? $sortDirection : null">Convênio
            </x-table.heading>
            <x-table.heading sortable wire:click="sortBy('protocols.user_id')"
                             :direction="$sortField === 'protocols.user_id' ? $sortDirection : null">Usuário
            </x-table.heading>
            <x-table.heading>Verificado</x-table.heading>
            <x-table.heading>Status</x-table.heading>
            <x-table.heading>Ações</x-table.heading>

        </x-slot>

        <x-slot name="body">
            @foreach ($selectedStatus as $exam)
                @php
                    $exam_status = $exam->find($exam->exam_status_id)->relExamStatus;
                @endphp
                <x-table.row>
                    <x-table.cell>{{
                    date('d/m/Y', strtotime($exam->exam_date)) }}</x-table.cell>
                    <x-table.cell>{{ $exam->paciente_name ?? '?' }}</x-table.cell>
                    <x-table.cell>{{ $exam->name ?? '?' }}</x-table.cell>
                    <x-table.cell>{{ $exam->convenio ?? '?' }}</x-table.cell>
                    <x-table.cell>{{ $exam->requester->name ?? '?' }} {{substr($exam->requester->lastname, 0, 15) ?? '?'}}</x-table.cell>
                    <x-table.cell class="text-center">
                        <x-icon name="check-circle" class="w-6 h-6" :fill="$exam->recebido == 1 ? 'green' : 'gray'"
                                solid></x-icon>
                    </x-table.cell>
                    <x-table.cell>{{ $exam_status->name ?? '?' }}</x-table.cell>
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
        </x-slot>
    </x-table>
    {{$selectedStatus->links()}}
</div>
