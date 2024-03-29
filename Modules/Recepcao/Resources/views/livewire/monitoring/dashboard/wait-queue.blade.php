<div>
    <div>
        @include('recepcao::livewire.monitoring.dashboard.queue-stats')
    </div>
    <div wire:poll.5000ms='refreshMe'>
        <div class="grid grid-cols-1 gap-1 px-2 py-2 sm:grid-cols-10">
            <div class="col-span-1 sm:col-span-5">
                <div class="text-center">
                <span class="p-2 text-xl font-bold text-gray-800 dark:text-gray-50 ">
                    Pacientes sem agendamento
                </span>
                </div>
                <div class="overflow-auto bg-white dark:bg-gray-800 h-96 ">
                    <x-table>
                        <x-slot name="head">
                            <x-table.heading>Status</x-table.heading>
                            <x-table.heading>Senha</x-table.heading>
                            <x-table.heading>Hora Chegada</x-table.heading>
                            <x-table.heading>Hora Atual</x-table.heading>
                            <x-table.heading>Espera</x-table.heading>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($scheduling->sortBy('HORACHEGADA') as $agendamento)
                                @php
                                    //$espera = strtotime(now('H:i:s')) - $aguardando->HORACHEGADA;
                                @endphp
                                <x-table.row>
                                    <x-table.cell>
                                        @if($agendamento->ATRASO < 600)
                                            <x-icon name="emoji-happy" class="w-10 h-10 text-green-500" solid>
                                            </x-icon>
                                        @elseif($agendamento->ATRASO >= 600 && $agendamento->ATRASO < 900)
                                            <x-icon name="emoji-neutral"
                                                    class="w-10 h-10 text-yellow-400" solid>
                                            </x-icon>
                                        @else
                                            <x-icon name="emoji-sad" class="w-10 h-10 text-red-600" solid></x-icon>
                                        @endif
                                    </x-table.cell>
                                    <x-table.cell>
                                        {{$agendamento->SENHA}}
                                    </x-table.cell>
                                    <x-table.cell>
                                        {{gmdate('H:i:s', $agendamento->HORACHEGADA)}}
                                    </x-table.cell>
                                    <x-table.cell>
                                        {{now()->format('H:i:s')}}
                                    </x-table.cell>
                                    <x-table.cell>
                                        {{gmdate('H:i:s', $agendamento->ATRASO)}}
                                    </x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-slot>
                    </x-table>
                </div>
            </div>
            <div class="col-span-1 sm:col-span-5">
                <div class="text-center">
                <span class="p-2 text-xl font-bold text-gray-800 dark:text-gray-50 ">
                    Pacientes com agendamento
                </span>
                </div>
                <div class="overflow-auto bg-white dark:bg-gray-800 h-96 ">
                    <x-table>
                        <x-slot name="head">
                            <x-table.heading>Status</x-table.heading>
                            <x-table.heading>Senha</x-table.heading>
                            <x-table.heading>Hora Chegada</x-table.heading>
                            <x-table.heading>Hora Exame</x-table.heading>
                            <x-table.heading>Atraso</x-table.heading>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($service->sortBy('HORACHEGADA') as $atendimento)
                                @php
                                    //$espera = strtotime(now('H:i:s')) - $aguardando->HORACHEGADA;
                                @endphp
                                <x-table.row>
                                    <x-table.cell>
                                        @if($atendimento->ATRASO < 600)
                                            <x-icon name="emoji-happy" class="w-10 h-10 text-green-500" solid>
                                            </x-icon>
                                        @elseif($atendimento->ATRASO >= 600 && $atendimento->ATRASO < 900)
                                            <x-icon name="emoji-neutral"
                                                    class="w-10 h-10 text-yellow-400" solid>
                                            </x-icon>
                                        @else
                                            <x-icon name="emoji-sad" class="w-10 h-10 text-red-600" solid></x-icon>
                                        @endif
                                    </x-table.cell>
                                    <x-table.cell>
                                        {{$atendimento->SENHA}}
                                    </x-table.cell>
                                    <x-table.cell>
                                        {{gmdate('H:i:s', $atendimento->HORACHEGADA)}}
                                    </x-table.cell>
                                    <x-table.cell>
                                        @php
                                            $exam_hour = $this->searchSchedule($atendimento->HORAEXAME);
                                        @endphp
                                        {{gmdate('H:i:s', $exam_hour->HORA_EXAME)}}
                                    </x-table.cell>
                                    <x-table.cell>
                                        {{gmdate('H:i:s', $atendimento->ATRASO)}}
                                    </x-table.cell>
                                </x-table.row>
                            @endforeach
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </div>
        <div class="text-center ">
        <span class="text-sm text-gray-500 font-regular">
            Última atualização: {{now()->format('d/m/Y H:i:s')}}
        </span>
        </div>
        <div class="w-full text-end">
            <a type="button" href="{{route('recepcao.monitoring')}}" class="text-end">
                <x-icon name="logout" class="w-6 h-6 text-gray-500 hover:text-gray-800"/>
            </a>
        </div>
    </div>

    <div class="fixed bottom-4 right-4 inline-flex space-x-2">
        <div>
            <a type="button" href="{{route('recepcao.reports.wait-queue')}}">
                <button
                    class="bg-blue-600 hover:bg-blue-600 text-white font-bold py-2 px-2 rounded-full shadow-lg bg-opacity-50 hover:bg-opacity-100">
                    <x-icon name="document-report" class="h-5 w-5 text-white"></x-icon>
                </button>
            </a>
        </div>
        <div>
            <a type="button" href="{{route('recepcao.monitoring')}}">
                <button
                    class="bg-gray-600 hover:bg-gray-600 text-white font-bold py-2 px-2 rounded-full shadow-lg bg-opacity-50 hover:bg-opacity-100">
                    <x-icon name="logout" class="h-5 w-5 text-white"></x-icon>
                </button>
            </a>
        </div>
    </div>

</div>
