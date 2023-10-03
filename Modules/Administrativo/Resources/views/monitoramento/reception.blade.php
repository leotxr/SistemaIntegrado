@extends('administrativo::layouts.guest')
@section('header')

<h2 class="text-xl font-bold leading-tight text-center text-gray-800 dark:text-gray-200">
    Fila de Espera Recepção
</h2>

@endsection
@section('content')
@livewire('administrativo::monitoring.reception-queue')
@endsection