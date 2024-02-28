@php
    if(Route::is('laudo.reports.exams-without-report'))
        {
            $livewire = 'laudo::reports.exams-without-report';
            $current_page = 'Exames sem Laudar';
        }
    elseif(Route::is('laudo.reports.exams-without-signature'))
    {
        $livewire = 'laudo::reports.exams-without-signature';
        $current_page = 'Exames sem Assinar';
    }
    elseif(Route::is('laudo.reports.exams-to-review'))
    {
        $livewire = 'laudo::reports.exams-to-review';
        $current_page = 'Exames pendentes de Revisão';
    }
        elseif(Route::is('laudo.reports.exams-without-doctor'))
    {
        $livewire = 'laudo::reports.exams-without-doctor';
        $current_page = 'Exames sem médico vinculado';
    }

@endphp
@extends('laudo::layouts.master')
@section('header')
    <x-breadcrumb>
        <a href="{{route('laudo.index')}}">
            Início
        </a>
        <x-slot name="page">
            <x-breadcrumb.page>Laudo</x-breadcrumb.page>
            <x-breadcrumb.page>Relatórios</x-breadcrumb.page>
            <x-breadcrumb.page current>{{$current_page}}</x-breadcrumb.page>
        </x-slot>
    </x-breadcrumb>
@endsection
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full px-12 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    @livewire($livewire)
                </div>
            </div>
        </div>
    </div>

@endsection
