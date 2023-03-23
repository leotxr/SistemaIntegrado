@extends('triagem::layouts.master')

@section('content')
    <div class="shadow-md">
        <h1 class="text-xl sm:text-3xl font-bold text-gray-800 dark:text-gray-500 m-5">Fila de Exames Ressonância (X-Clinic) </h1>
        <div class="sm:grid justify-items-center m-2">
        @include('triagem::layouts.partials.tables.table-fila-rm')
        </div>
    </div>

@endsection
