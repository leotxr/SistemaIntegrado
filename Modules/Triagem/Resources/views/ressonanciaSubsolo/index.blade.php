@extends('triagem::layouts.master')
@section('header')

    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __("Triagens realizadas - Ressonância Subsolo " . date('d/m/Y')) }}
    </h2>

@endsection
@section('content')
<div class="m-4 shadow-sm">
    <div class="max-w-full px-12 justify-items-center">
            @livewire('triagem::tables.table-triagem', ['sector' => $sector])
        </div>
    </div>
@endsection