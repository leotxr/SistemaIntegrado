<div>
    @php
    $solicitante = $ticket->find($ticket->id)->TicketRequester;
    @endphp
    <x-title class="text-3xl font-bold text-gray-900 dark:text-gray-50">Detalhes do Chamado <span class="text-blue-600">
            #{{$ticket->id}}</span></x-title>
    <div class="grid grid-cols-3 gap-4">
        <div
            class="col-span-2 p-4 text-gray-900 bg-white rounded-lg shadow-md bg-opacity-80 dark:bg-gray-800 dark:text-gray-50">
            mensagens
        </div>
        <div class="p-4 text-gray-900 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-50">
            <x-title class="text-xl font-bold text-gray-900 dark:text-gray-50">Solicitante</x-title>
            <div class="flex">
                <div>
                    <img class="w-10 h-10 rounded-full" src="{{URL::asset($solicitante->profile_img)}}" alt="Rounded avatar">
                </div>
                <div>
                </div>
            </div>
        </div>
        <div
            class="col-span-2 p-4 text-gray-900 bg-white rounded-lg shadow-md bg-opacity-80 dark:bg-gray-800 dark:text-gray-50">
            detalhes, categoria, subcategoria
        </div>
        <div class="p-4 text-gray-900 bg-white rounded-lg shadow-md bg-opacity-80 dark:bg-gray-800 dark:text-gray-50">
            detalhes, hora, tempo
        </div>
    </div>
</div>