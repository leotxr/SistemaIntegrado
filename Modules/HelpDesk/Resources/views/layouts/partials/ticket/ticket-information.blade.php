<div class="border">
    <div class="border bg-base-200 p-2 font-medium text-center text-sm sm:text-lg text-gray-800 dark:text-gray-400 h-10 w-full">
    Informações do Chamado
    </div>

    <div class="grid grid-rows-6 gap-2 sm:grid-row-6 w-full p-2 h-96 flex-wrap">
        <div>
            <strong>Responsável:</strong> {{$atendente->name ?? ''}}
        </div>
        <div>
            <strong>Setor:</strong> 
        </div>
        <div>
            <strong>Categoria:</strong> {{$categoria->nome ?? ''}}
        </div>
        <div>
            <strong>Sub-Categoria:</strong>
        </div>
        <div>
        <strong>Criado em:</strong> {{$chamado->hora_abertura ?? ''}}
        </div>
        <div>
            <strong>Solicitante:</strong> {{$solicitante->name ?? ''}}
        </div>
    </div>
</div>