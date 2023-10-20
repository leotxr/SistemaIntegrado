@extends('orcamento::layouts.master')
@section('header')

<h2 class="space-x-2 text-xl leading-tight text-gray-800 divide-x-2 dark:text-gray-200 divide">
    <span class="font-light"><a href="{{route('orcamento.index')}}"> Orçamentos </a></span> <span class="px-2 font-bold">Relatórios</span>
</h2>

@endsection
@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <ul class="max-w-md space-y-2 list-inside divide-y divide-y-reverse" x-data="{
        items: [
            {id: 1, label: 'Solicitações alteradas', desc: 'Exibe solicitações que tiveram status alterado por algum atendente.', link: 'relatorio/solicitacoes-alteradas'},
            {id: 2, label: 'Totalizador Solicitações alteradas por Status', desc: 'Exibe o total de solicitações que foram alteradas por um usuário.', link: 'relatorio/totalizador-solicitacoes-alteradas'},
            {id: 3, label: 'Totalizador Solicitações criadas por Status', desc: 'Exibe o total de solicitações criadas por status', link: 'relatorio/totalizador-solicitacoes-criadas'},
            {id: 4, label: 'Orçamentos por Data de Criação x Edição', desc: 'Exibe os orçamentos realizados em uma determinada data combinados com a data de atualização.', link: 'relatorio/solicitacoes-criadas-x-alteradas'}
        ]
    }">
                    <template x-for="item in items" :key="item.id">
                        <li>
                            <a :href="item.link">
                                <span class="text-xl font-bold text-gray-700 dark:text-gray-50"
                                    x-text="item.label"></span>
                                <dd class="text-sm font-light text-gray-500 dark:text-gray-300" x-text="item.desc"></dd>
                            </a>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection