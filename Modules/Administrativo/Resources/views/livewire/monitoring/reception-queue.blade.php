<div wire:poll.5000ms='refreshMe'>
    {{date('H:i:sa')}}
    {{strtotime(date('H:i:sa'))}}
    <div
        class="grid w-full grid-cols-2 gap-1 px-2 py-4 bg-white divide-x-2 shadow-sm dark:bg-gray-800 sm:grid-cols-10 divide-solid">
        <div class="col-span-2 text-center sm:col-span-2">
            <div>
                <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$queue->count()}}</span>
            </div>
            <div>
                <span class="text-gray-500 text-md font-regular dark:text-gray-200">Total</span>
            </div>
        </div>

        <div class="col-span-2 text-center sm:col-span-2">
            <div>
                <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$served->count()}}</span>
            </div>
            <div>
                <span class="text-gray-500 text-md font-regular dark:text-gray-200">Atendidos</span>
            </div>
        </div>

        <div class="col-span-2 text-center sm:col-span-2">
            <div>
                <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$waiting->count()}}</span>
            </div>
            <div>
                <span class="text-gray-500 text-md font-regular dark:text-gray-200">Aguardando</span>
            </div>
        </div>

        <div class="col-span-2 text-center sm:col-span-2">
            <div>
                <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$queue->where('TIPOFILA',
                    'A')->count()}}</span>
            </div>
            <div>
                <span class="text-gray-500 text-md font-regular dark:text-gray-200">Atendimento</span>
            </div>
        </div>

        <div class="col-span-2 text-center sm:col-span-2">
            <div>
                <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$queue->whereIn('TIPOFILA', ['T',
                    'P'])->count()}}</span>
            </div>
            <div>
                <span class="text-gray-500 text-md font-regular dark:text-gray-200">Marcação</span>
            </div>
        </div>


    </div>
    <div class="grid grid-cols-1 gap-1 px-2 py-2 sm:grid-cols-10">
        <div class="col-span-1 overflow-auto bg-white h-96 sm:col-span-5 dark:bg-gray-800">
            <x-table>
                <x-slot name="head">
                    <x-table.heading>Status</x-table.heading>
                    <x-table.heading>Senha</x-table.heading>
                    <x-table.heading>Hora Chegada</x-table.heading>
                    <x-table.heading>Atual</x-table.heading>
                    <x-table.heading>Espera</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach($waiting->sortByDesc('HORACHEGADA') as $aguardando)
                    @php
                    //$espera = strtotime(now('H:i:s')) - $aguardando->HORACHEGADA;
                    @endphp
                    <x-table.row>
                        <x-table.cell>
                            @if($aguardando->ATRASO < 900) <x-icon name="emoji-happy" class="w-10 h-10 text-green-500" solid>
                                </x-icon>
                                @else
                                <x-icon name="emoji-sad" class="w-10 h-10 text-red-600" solid></x-icon>
                                @endif
                        </x-table.cell>
                        <x-table.cell>
                            {{$aguardando->SENHA}}
                        </x-table.cell>
                        <x-table.cell>
                            {{gmdate('H:i:s', $aguardando->HORACHEGADA)}}
                        </x-table.cell>
                        <x-table.cell>
                            {{now()->format('H:i:s')}}
                        </x-table.cell>
                        <x-table.cell>
                            {{gmdate('H:i:s', $aguardando->ATRASO)}}
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>

        </div>
        <div class="col-span-1 overflow-auto bg-white h-96 sm:col-span-5 dark:bg-gray-800">
            <x-table>
                <x-slot name="head">
                    <x-table.heading>Status</x-table.heading>
                    <x-table.heading>Senha</x-table.heading>
                    <x-table.heading>Hora Chegada</x-table.heading>
                    <x-table.heading>Atendimento</x-table.heading>
                    <x-table.heading>Espera</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach($served->sortByDesc('HORACHEGADA') as $atendido)
                    @php
                    $espera = $atendido->HORAATEND - $atendido->HORACHEGADA;
                    @endphp
                    <x-table.row>
                        <x-table.cell>
                            @if($espera < 900) <x-icon name="emoji-happy" class="w-10 h-10 text-green-500" solid>
                                </x-icon>
                                @else
                                <x-icon name="emoji-sad" class="w-10 h-10 text-red-600" solid></x-icon>
                                @endif
                        </x-table.cell>
                        <x-table.cell>
                            {{$atendido->SENHA}}
                        </x-table.cell>
                        <x-table.cell>
                            {{gmdate('H:i:s', $atendido->HORACHEGADA)}}
                        </x-table.cell>
                        <x-table.cell>
                            {{gmdate('H:i:s', $atendido->HORAATEND)}}
                        </x-table.cell>
                        <x-table.cell>
                            {{gmdate('H:i:s', $espera)}}
                        </x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
        </div>

    </div>


</div>