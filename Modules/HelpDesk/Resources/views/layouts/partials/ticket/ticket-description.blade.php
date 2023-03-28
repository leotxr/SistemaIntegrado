<div>
    <div class="border p-2">
        <div>
            @include('helpdesk::layouts.partials.components.auth-user-avatar')
            <div class="text-gray-800 font-medium p-2">
                {{$chamado->descricao_fechamento}}
            </div>
        </div>
    </div>
    <div class="border p-2">
        <div>
            @include('helpdesk::layouts.partials.components.message-avatar')
            <div class="text-gray-800 font-medium p-2">
                {{$chamado->descricao_abertura}}
            </div>
        </div>
    </div>
</div>