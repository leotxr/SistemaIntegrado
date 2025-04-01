@extends('nc::layouts.master')
@section('header')
    <x-title class="text-xl font-bold">Total de Não Conformidades recebidas por Funcionário</x-title>
@endsection
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full px-12 ">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-full">
                    <div>
                    @livewire('nc::reports.received-by-employee')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
