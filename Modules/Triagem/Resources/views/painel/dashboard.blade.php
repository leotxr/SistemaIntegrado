@extends('triagem::layouts.master')
@section('header')

    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __("Painel de informações - Módulo Triagem") }}
    </h2>

@endsection
@section('content')
<div class="m-4 shadow-sm">
    <div class="max-w-full p-12 space-y-12">
            @livewire('triagem::dashboard.show-stats')
        </div>
    </div>

@endsection