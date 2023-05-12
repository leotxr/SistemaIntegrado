@extends('triagem::layouts.master')
@section('content')
    <div class="shadow-md">
        <h1 class="m-5 text-xl font-bold text-gray-800 sm:text-3xl dark:text-gray-500">Fila de Exames Ressonância (X-Clinic)
        </h1>
        <div class="m-2 sm:grid justify-items-center">
            @livewire('triagem::tables.table-queue', ['title' => "Fila de Exames Ressonância (X-Clinic)", 'pacientes' => $pacientes, 'triagens' => $triagens, 'setor' => $setor])
        </div>
    </div>
@endsection
