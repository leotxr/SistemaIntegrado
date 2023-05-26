<div class="justify-center">
    <div>
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
    <div class="p-2 bg-white shadow sm:p-4 dark:bg-gray-800 sm:rounded-lg">
        <form wire:submit.prevent='render'>
            <x-accordion>
                <x-slot name="title">
                    <div class="text-gray-900 dark:text-white font-bold justify-start flex mx-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                        </svg>
                        <h1>Filtros<h1>
                    </div>
                </x-slot>
                <x-slot name="content">
                    <div class="max-w-full">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 content-center">
                            <div>
                                <label for="date"
                                    class="label text-gray-900 dark:text-gray-50 font-light text-sm">Data</label>
                                <input type="date" wire:model.defer='date' id="date" class="input border-gray-300">
                            </div>
                            <div>
                                <label for="setores"
                                    class="label text-gray-900 dark:text-gray-50 font-light text-sm">Setores</label>
                                <div id="setores">
                                    <div class="flex items-center mb-4">
                                        <input wire:model.defer='sec' id="default-checkbox" type="checkbox" value="31"
                                            name="sec[]"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="default-checkbox"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ressonância</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input wire:model='sec' id="checked-checkbox" type="checkbox" value="14"
                                            name="sec[]"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checked-checkbox"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tomografia</label>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="submit"
                                    class="label text-gray-900 dark:text-gray-50 font-light text-sm">Gerar
                                    relatório</label>
                                <x-primary-button id="submit" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                    <span>Buscar<span>
                                </x-primary-button>
                            </div>
                        </div>
                    </div>
                </x-slot>
            </x-accordion>
        </form>
        <div class="pt-2 text-sm text-gray-900 dark:text-white">
            <p>Mostrando resultados referentes às triagens do dia: {{$date}}</p>
        </div>

    </div>


    <div class="bg-white overflow-x-auto shadow-sm border-2 w-full mt-2">
        <table class="table table-compact">
            <!-- head -->
            <thead>
                <tr>
                    <th>Hora Exame</th>
                    <th>Entrada Exame</th>
                    <th>Saída Exame</th>
                    <th>Nome</th>
                    <th>Procedimento</th>
                    <th>Status</th>

                </tr>
            </thead>
            {{$pacientes->links()}}
            <tbody>

                @foreach ($pacientes as $paciente)

                @php

                $a = $triagens->where('patient_id', $paciente->PACIENTEID)->value('patient_id');

                //echo $a;
                if ($a == $paciente->PACIENTEID) {
                $status = 'REALIZADO';
                $color = 'bg-green-100';
                } else {
                $status = 'AGUARDANDO';
                $color = 'bg-red-100';
                }

                @endphp

                <tr>
                    <th class="{{ $color }}">{{ $paciente->HORA }}</th>
                    <td class="{{ $color }}">{{ $paciente->ENTRADA }}</td>
                    <td class="{{ $color }}">{{ $paciente->SAIDA }}</td>
                    <td class="{{ $color }}">{{ $paciente->PACIENTE }}</td>
                    <td class="{{ $color }}">{{ $paciente->PROCEDIMENTO }}</td>
                    <td class="{{ $color }}">
                        @isset($a)
                        <button type="button" wire:click='showTriagem({{$a}})'>
                            Mais
                        </button>
                        @endisset
                        @empty($a)
                        <strong>{{ $status }}</strong>
                        @endempty
                    </td>
                </tr>

                @endforeach

                <div wire:loading.block class="text-center min-h-16">
                    <div role="status">
                        <svg aria-hidden="true"
                            class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Carregando...</span>
                    </div>
                </div>

            </tbody>
        </table>
    </div>

    @isset($showing)
    {{--MODAL--}}
    <x-modal.dialog wire:model.defer="modalTriagem">
        <x-slot name="title">
            <div class="text-center">
                <x-title>Informações da Triagem</x-title>
            </div>
        </x-slot>
        <x-slot name="content">
            
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Paciente</dt>
                    <dd class="text-md font-semibold">{{$showing->patient_name}}</dd>
                </div>

            <div class="grid grid-cols-2 gap-4 text-center">
                <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex flex-col pb-3 border-2 rounded-md">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Início da Triagem</dt>
                        <dd class="text-md font-semibold">{{$showing->start_hour}}</dd>
                    </div>
                </dl>
                <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex flex-col pb-3 border-2 rounded-md">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Final da Triagem</dt>
                        <dd class="text-md font-semibold">{{$showing->final_hour}}</dd>
                    </div>
                </dl>
                <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex flex-col pb-3 border-2 rounded-md">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Tempo de Triagem</dt>
                        <dd class="text-md font-semibold">
                            @if($showing->final_hour)
                            @php
                            $tempo = gmdate('H:i:s', strtotime( $showing->final_hour ) - strtotime(
                            $showing->start_hour
                            )
                            );
                            @endphp
                            {{$tempo}}
                            @endif
                        </dd>
                    </div>
                </dl>
                @php
                $enfermeira = $showing->find($showing->id)->relUserTerm;
                @endphp
                <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex flex-col pb-3 border-2 rounded-md">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Enfermeira</dt>
                        <dd class="text-md font-semibold">{{$enfermeira->name}}</dd>
                    </div>
                </dl>
                <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex flex-col pb-3 border-2 rounded-md">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status</dt>
                        <dd class="text-md font-semibold">@if($showing->finished == 1) Finalizada @else Não
                            Finalizada
                            @endif</dd>
                    </div>
                </dl>
            </div>
            <div>
                <dl class="max-w-full text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700 mt-4">
                    <div class="flex flex-col pb-3 border-2 rounded-md">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Observação</dt>
                        <dd class="text-md font-semibold">{{$showing->observation}}</dd>
                    </div>
                </dl>
            </div>

        </x-slot>
        <x-slot name="footer">
            <x-secondary-button x-on:click="$dispatch('close')" class="mx-2">Fechar</x-secondary-button>
        </x-slot>
        </form>
    </x-modal.dialog>
    @endisset





</div>