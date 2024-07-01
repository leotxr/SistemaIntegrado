@extends('administrativo::layouts.master')
@section('header')
    <x-breadcrumb>
        <a href="{{route('administrativo.index')}}">
            Início
        </a>
        <x-slot name="page">
            <x-breadcrumb.page>Serviços Extras</x-breadcrumb.page>
            <x-breadcrumb.page current>Painel</x-breadcrumb.page>
        </x-slot>
    </x-breadcrumb>
@endsection
@section('content')
    <div class="shadow-sm">
        <div class="max-w-full justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    @livewire('administrativo::extra-service.dashboard.show-extra-services')
                </div>
            </div>
        </div>
    </div>
@endsection
