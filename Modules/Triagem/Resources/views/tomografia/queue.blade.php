@extends('triagem::layouts.master')
@section('content')
    <div class="shadow-md">
        <h1 class="text-xl sm:text-3xl font-bold text-gray-800 dark:text-gray-500 m-5">Fila de Exames Tomografia (X-Clinic)
        </h1>
        <div class="sm:grid justify-items-center m-2">
            @livewire('triagem::tables.table-queue', ['title' => "Fila de Exames Tomografia (X-Clinic)", 'pacientes' => $pacientes, 'triagens' => $triagens])
        </div>
    </div>
@endsection
