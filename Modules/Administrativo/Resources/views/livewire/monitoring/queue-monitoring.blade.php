<div>
    <div wire:poll>
        <div class="grid grid-cols-1 gap-4 py-8 justify-items-center sm:grid-cols-3 content-evenly">
            <div class="text-center text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor" class="bi bi-emoji-angry"
                    viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                        d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zm6.991-8.38a.5.5 0 1 1 .448.894l-1.009.504c.176.27.285.64.285 1.049 0 .828-.448 1.5-1 1.5s-1-.672-1-1.5c0-.247.04-.48.11-.686a.502.502 0 0 1 .166-.761l2-1zm-6.552 0a.5.5 0 0 0-.448.894l1.009.504A1.94 1.94 0 0 0 5 6.5C5 7.328 5.448 8 6 8s1-.672 1-1.5c0-.247-.04-.48-.11-.686a.502.502 0 0 0-.166-.761l-2-1z" />
                </svg>
                <span class="text-2xl font-bold">{{$queue->where('STATUSID',
                    0)->where('ATRASO', '>', '1200')->count()}}</span>
            </div>
            <div class="text-center text-yellow-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor"
                    class="bi bi-emoji-neutral" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                        d="M4 10.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5zm3-4C7 5.672 6.552 5 6 5s-1 .672-1 1.5S5.448 8 6 8s1-.672 1-1.5zm4 0c0-.828-.448-1.5-1-1.5s-1 .672-1 1.5S9.448 8 10 8s1-.672 1-1.5z" />
                </svg>
                <span class="text-2xl font-bold">{{$queue->where('STATUSID',
                    0)->where('ATRASO', '>', '600' )->where('ATRASO', '<', '1200')->count()}}</span>
            </div>
            <div class="text-center text-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24" fill="currentColor"
                    class="bi bi-emoji-laughing" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                        d="M12.331 9.5a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5zM7 6.5c0 .828-.448 0-1 0s-1 .828-1 0S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 0-1 0s-1 .828-1 0S9.448 5 10 5s1 .672 1 1.5z" />
                </svg>
                <span class="text-2xl font-bold">{{$queue->where('STATUSID',
                    2)->count()}}</span>
            </div>
        </div>
        <div>
            <p class="text-sm font-light text-gray-700"> Ultima Atualização: {{now()}} </p>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <x-table>
                <!-- head -->
                <x-slot name="head">

                    <x-table.heading>Médico</x-table.heading>
                    <x-table.heading>Aguardando</x-table.heading>
                    <x-table.heading>Atrasos após 10min</x-table.heading>
                    <x-table.heading>Atrasos após 20min</x-table.heading>
                    <x-table.heading>Atendidos</x-table.heading>

                </x-slot>
                <x-slot name="body">
                    @foreach($filas as $fila)

                    <x-table.row class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <x-table.cell scope="row"
                            class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$fila['name']}}</x-table.cell>
                        <x-table.cell class="text-2xl font-bold">{{$queue->where('FILAID',
                            $fila['id'])->where('STATUSID',
                            0)->count()}}</x-table.cell>
                        <x-table.cell class="text-2xl font-bold">{{$queue->where('FILAID',
                            $fila['id'])->where('STATUSID',
                            0)->where('ATRASO', '<', '1200' )->where('ATRASO', '>', '600')->count()}}</x-table.cell>
                        <x-table.cell class="text-2xl font-bold">{{$queue->where('FILAID',
                            $fila['id'])->where('STATUSID',
                            0)->where('ATRASO', '>', '1200')->count()}}</x-table.cell>
                        <x-table.cell class="text-2xl font-bold">{{$queue->where('FILAID',
                            $fila['id'])->where('STATUSID',
                            2)->count()}}</x-table.cell>
                    </x-table.row>
                    @endforeach
                    <x-table.row class="font-extrabold text-black">
                        <x-table.cell> Total</x-table.cell>
                        <x-table.cell class="text-2xl">{{$queue->where('STATUSID',
                            0)->count()}}</x-table.cell>
                        <x-table.cell class="text-2xl">{{$queue->where('STATUSID',
                            0)->where('ATRASO', '<', '1200' )->where('ATRASO', '>', '600')->count()}}</x-table.cell>
                        <x-table.cell class="text-2xl">{{$queue->where('STATUSID',
                            0)->where('ATRASO', '>', '1200')->count()}}</x-table.cell>
                        <x-table.cell class="text-2xl">{{$queue->where('STATUSID',
                            2)->count()}}</x-table.cell>
                    </x-table.row>
                </x-slot>
            </x-table>
        </div>

        {{--
        @foreach($queue->where('ATRASO', '<', '600' )->where('ATRASO', '>', 0)->where('STATUSID', 0) as $q)
            <p>NOME = {{$q->NOME}} - ATRASO = {{$q->ATRASO}} - FILA = {{$q->FILAID}} - AGORA = {{$q->AGORACONV}} - HORA
                AGENDA = {{$q->AGENDA}}</p>
            @endforeach
            --}}

    </div>
</div>