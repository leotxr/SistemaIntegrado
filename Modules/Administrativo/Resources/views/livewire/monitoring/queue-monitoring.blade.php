<div>
    <div wire:poll>
        <div class="grid grid-cols-1 gap-4 py-2 sm:grid-cols-9 justify-items-center">
            <div class="text-center text-red-600 col-span-1 sm:col-span-3">
                <x-icon name="emoji-sad" class="w-20 h-20 text-red-600" solid></x-icon>
                <span class="text-3xl font-bold ">{{$queue->where('STATUSID',
                    0)->where('ATRASO', '>', '600' )->where('ATRASO', '<', '1200' )->count()}}</span>
            </div>
            <div class="text-center text-blue-600 col-span-1 sm:col-span-3">
                <x-icon name="dots-circle-horizontal" class="w-20 h-20 text-blue-600" solid></x-icon>
                <span class="text-2xl font-bold ">{{$queue->where('STATUSID',
                    1)->count()}}</span>
            </div>
            <div class="text-center text-green-500 col-span-1 sm:col-span-3">
                <x-icon name="emoji-happy" class="w-20 h-20 text-green-600" solid></x-icon>
                <span class="text-2xl font-bold ">{{$queue->where('STATUSID',
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
                    <x-table.heading>Em Atendimento</x-table.heading>
                    <x-table.heading>Atendidos</x-table.heading>

                </x-slot>
                <x-slot name="body">
                    @foreach($filas as $fila)
                        @if($queue->where('FILAID',
                        $fila['id'])->where('STATUSID',
                        0)->count() > 0 || $queue->where('FILAID',
                        $fila['id'])->where('STATUSID',
                        2)->count() > 0)

                            <x-table.row class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <x-table.cell scope="row"
                                              class="px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                    {{$fila['name']}}</x-table.cell>
                                <x-table.cell class="text-2xl font-bold text-center">{{$queue->where('FILAID',
                            $fila['id'])->where('STATUSID',
                            0)->count()}}</x-table.cell>
                                <x-table.cell class="text-2xl font-bold text-center">{{$queue->where('FILAID',
                            $fila['id'])->where('STATUSID',
                            0)->where('ATRASO', '<', '1200' )->where('ATRASO', '>', '600')->count()}}</x-table.cell>
                                <x-table.cell class="text-2xl font-bold text-center">{{$queue->where('FILAID',
                            $fila['id'])->where('STATUSID',
                            1)->count()}}</x-table.cell>
                                <x-table.cell class="text-2xl font-bold text-center">{{$queue->where('FILAID',
                            $fila['id'])->where('STATUSID',
                            2)->count()}}</x-table.cell>
                            </x-table.row>
                        @endif
                    @endforeach
                    <x-table.row class="font-extrabold text-black">
                        <x-table.cell class="text-center"> Total</x-table.cell>
                        <x-table.cell class="text-2xl text-center">{{$queue->where('STATUSID',
                            0)->count()}}</x-table.cell>
                        <x-table.cell class="text-2xl text-center">{{$queue->where('STATUSID',
                            0)->where('ATRASO', '<', '1200' )->where('ATRASO', '>', '600')->count()}}</x-table.cell>
                        <x-table.cell class="text-2xl text-center">{{$queue->where('STATUSID',
                            1)->count()}}</x-table.cell>
                        <x-table.cell class="text-2xl text-center">{{$queue->where('STATUSID',
                            2)->count()}}</x-table.cell>
                    </x-table.row>
                </x-slot>
            </x-table>
        </div>

    </div>
    <div class="w-full text-end">
        <a type="button" href="/administrativo" class="text-end">
            <x-icon name="logout" class="w-6 h-6 text-gray-500 hover:text-gray-800"/>
        </a>
    </div>
</div>
