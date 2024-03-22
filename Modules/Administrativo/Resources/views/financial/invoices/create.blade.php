@extends('administrativo::layouts.master')
@section('header')
    <x-breadcrumb>
        <a href="{{route('administrativo.index')}}">
            Início
        </a>
        <x-slot name="page">
            <x-breadcrumb.page>Financeiro</x-breadcrumb.page>
            <x-breadcrumb.page>Exames Sirius</x-breadcrumb.page>
            <x-breadcrumb.page current>Importar Exames</x-breadcrumb.page>
        </x-slot>
    </x-breadcrumb>
@endsection
@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-50">Buscar Exame</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-100">Insira o código da fatura (exame) gerado pelo X-Clinic para buscar as informações referentes ao atendimento.
                    </p>
                </div>
            </div>
            <div class="form_busca mt-5 md:col-span-2 md:mt-0">
                @livewire('administrativo::financial.form-invoice')
            </div>
        </div>
    </div>
@endsection
