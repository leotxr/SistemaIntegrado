<div>
    @php
    $mensagens = $chamado->find($chamado->id)->relTicketMessage;
    @endphp
    @foreach($mensagens as $mensagem)
    <div class="border p-2">
        <div>
            <div class="flex items-center space-x-4">
                <div class="font-medium dark:text-white">
                    <div>{{$solicitante->name}}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{$mensagem->created_at}}</div>
                </div>
            </div>
            <div class="text-gray-800 font-medium p-2">
                {{$mensagem->mensagem}}
            </div>
        </div>
    </div>
    @endforeach
    
</div>