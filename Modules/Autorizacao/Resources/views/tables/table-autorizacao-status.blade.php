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
            @foreach ($selectedStatus as $protocols)
                @php
                    $exam_status = $protocols->find($protocols->exam_status_id)->relExamStatus;
                @endphp
                <x-table.row>
                    <x-table.cell>{{
                    $protocols->exam_date }}</x-table.cell>
                    <x-table.cell>{{ $protocols->paciente_name ?? '?' }}</x-table.cell>
                    <x-table.cell>{{ $protocols->name ?? '?' }}</x-table.cell>
                    <x-table.cell>{{ $protocols->convenio ?? '?' }}</x-table.cell>
                    <x-table.cell>{{ $protocols->requester->name ?? '?' }} {{substr($protocols->requester->lastname, 0, 15) ?? '?'}}</x-table.cell>
                    <x-table.cell class="text-center">
                        @if($protocols->recebido == 1)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="green" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                      d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                      clip-rule="evenodd"/>
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                      d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
                                      clip-rule="evenodd"/>
                            </svg>
                        @endif


                    </x-table.cell>
                    <x-table.cell
                        class="text-{{$colors[$exam_status->id]}}-800 font-bold">{{ $exam_status->name ?? '?' }}
                    </x-table.cell>
                    <x-table.cell>

                        <button wire:click='openEdit({{$protocols->protocol_id}})'
                                class="text-blue-800 font-bold inline-flex"
                                type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                            </svg>
                            Editar
                        </button>

                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
    {{$selectedStatus->links()}}


    @include('autorizacao::modals.modals-edit')
</div>
