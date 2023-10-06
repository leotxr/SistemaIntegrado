@extends('orcamento::layouts.master')
@section('header')

<h2 class="space-x-2 text-xl leading-tight text-gray-800 divide-x-2 dark:text-gray-200 divide">
    <span class="font-light"><a href="{{route('orcamento.reports')}}"> Relatórios </a></span> <span class="px-2 font-bold">Solicitações por Criação x Alteração</span>
</h2>

@endsection
@section('content')
<div class="py-4">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-gray-100 shadow-sm dark:bg-gray-900 sm:rounded-lg">
            @livewire('orcamento::reports.created-changed-budgets')
        </div>
    </div>
</div>
@endsection