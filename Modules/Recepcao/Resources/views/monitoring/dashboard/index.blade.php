@extends('recepcao::layouts.monitoring')
@section('header')

    <h2 class="text-xl text-center font-bold leading-tight text-gray-800 dark:text-gray-200">
        Monitoramento de Filas X-Clinic
    </h2>

@endsection
@section('content')
@livewire('recepcao::monitoring.dashboard.wait-queue')
@endsection
