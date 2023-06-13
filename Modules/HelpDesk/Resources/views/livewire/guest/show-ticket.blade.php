<div>
    <div class="text-start">
        <x-title class="text-3xl font-bold">#{{$ticket->id}} - {{$ticket->title}}</x-title>
    </div>
    <div class="grid justify-end">
        <div class="flex">
            <div>
                @php
                $status = $ticket->find($ticket->id)->TicketStatus;
                $solicitante = $ticket->find($ticket->id)->TicketRequester;
                $atendente = $ticket->find($ticket->id)->TicketUser;
                @endphp
                <span class="text-sm font-bold mr-2 px-2.5 py-0.5 rounded text-white"
                    style="background-color: {{$colors[$status->id]}}">
                    {{$status->name}}
                </span>
            </div>
            <div>
                @if($ticket->ticket_close)
                <div class="font-bold">{{date('d/m/Y H:i:s', strtotime($ticket->ticket_close))}}</div>
                @endif
            </div>
        </div>
    </div>
    <div class="my-4">
        <div x-data="{ open: false }" x-on:click="open = ! open" class="border border-gray-300">
            <button  class="px-2 text-2xl font-light">Mais detalhes</button>
         
            <div x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90">
                
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="mx-2 mt-4">
                    <div class="flex text-lg font-bold">Solicitante:  <span class="space-x-1 font-light"> {{$solicitante->name}}</span></div>
                </div>
                <div class="mx-2 mt-4">
                    <div class="flex text-lg font-bold">Atendente:  <span class="space-x-1 font-light"> {{$atendente->name}}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>