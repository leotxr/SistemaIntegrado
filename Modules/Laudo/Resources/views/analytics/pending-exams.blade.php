@extends('laudo::layouts.master')
@section('header')
    <x-breadcrumb>
        <a href="{{route('laudo.index')}}">
            Início
        </a>
        <x-slot name="page">
            <x-breadcrumb.page>Laudo</x-breadcrumb.page>
            <x-breadcrumb.page>Indicadores</x-breadcrumb.page>
            <x-breadcrumb.page current>Exames Pendentes</x-breadcrumb.page>
        </x-slot>
    </x-breadcrumb>
@endsection
@section('content')
    <div class="m-2 shadow-sm">
        <div class="max-w-full px-12 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg space-y-4">
                <div>
                    @livewire('laudo::analytics.pending-exams')
                </div>
            </div>
        </div>
    </div>
@endsection
