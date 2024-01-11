@extends('triagem::layouts.master')
@section('header')

    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __("Relatórios - Comparativo X-Clinic x Sigma") }}
    </h2>

@endsection
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full px-12">

                @livewire('triagem::reports.report-compare')


        </div>
    </div>
@endsection
