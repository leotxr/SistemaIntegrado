@extends('administrativo::layouts.master')
@section('header')
    <x-breadcrumb>
        <a href="{{route('administrativo.index')}}">
            Início
        </a>
        <x-slot name="page">
            <x-breadcrumb.page>Financeiro</x-breadcrumb.page>
            <x-breadcrumb.page current>Painel</x-breadcrumb.page>
        </x-slot>
    </x-breadcrumb>
@endsection
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full sm:px-12 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    @livewire('administrativo::financial.show-invoices')
                </div>
            </div>
        </div>
    </div>
@endsection
