@extends('triagem::layouts.master')
@section('header')
    <x-title class="text-xl">Fila de Exames Ressonância - Subsolo (X-Clinic)</x-title>
@endsection
@section('content')
    <div class="shadow-md">
        <div class="m-2 sm:grid justify-items-center">
            @livewire('triagem::tables.table-queue', ['title' => "Fila de Exames Ressonância - Subsolo (X-Clinic)", 'pacientes' => $pacientes, 'triagens' => $triagens, 'setor' => $setor])
        </div>
    </div>
@endsection
