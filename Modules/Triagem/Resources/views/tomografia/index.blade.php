@extends('triagem::layouts.master')
@section('header')

    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __("Triagens realizadas - Tomografia " . date('d/m/Y')) }}
    </h2>

@endsection
@section('content')
    <div class="shadow-md">
        <div class="h-screen m-2 sm:grid justify-items-center">
            @livewire('triagem::tables.table-triagem', ['sector' => $sector])
        </div>
    </div>
@endsection