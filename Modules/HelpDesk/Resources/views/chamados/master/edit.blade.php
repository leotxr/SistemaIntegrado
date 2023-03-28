@extends('helpdesk::layouts.master')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="chamados-pendentes">
            @include('helpdesk::layouts.partials.ticket.ticket-action')
        </div>
        @php
        $categoria = $chamado->find($chamado->id)->relCategory;
        $status = $chamado->find($chamado->id)->relStatus;
        $solicitante = $chamado->find($chamado->id)->relSolicitante;
        $atendente = $chamado->find($chamado->id)->relAtendente;
        $subcategoria = $categoria->find($categoria->id)->relSubCategory;
        @endphp
        <div class="grid grid-rows-3 grid-flow-col gap-4">
            <div class="col-span-2">@include('helpdesk::layouts.partials.ticket.ticket-description')</div> {{--detalhes abertura e fechamento--}}
            <div class="row-span-2 col-span-2">@include('helpdesk::layouts.partials.ticket.ticket-message')</div>{{--mensagens--}}
            <div class="row-span-2">@include('helpdesk::layouts.partials.ticket.ticket-information')</div>{{--informacoes--}}
        </div>
    </div>
</div>

@endsection