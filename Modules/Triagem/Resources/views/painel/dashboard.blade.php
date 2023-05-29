@extends('triagem::layouts.master')
@section('header')

<h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
    {{ __("Painel de estatísticas - Módulo Triagem") }}
</h2>

@endsection
@section('content')
<div class="m-4 shadow-sm">
    <div class="max-w-full px-12">
        @livewire('triagem::dashboard.show-stats')
        @livewire('triagem::dashboard.charts.chart-triagens')
    </div>
</div>

@endsection