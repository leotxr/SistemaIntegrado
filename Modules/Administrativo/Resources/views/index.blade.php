@extends('administrativo::layouts.master')
@section('header')
    <x-breadcrumb>
        <a href="{{route('administrativo.index')}}">
            Início
        </a>
        <x-slot name="page">

        </x-slot>
    </x-breadcrumb>
@endsection
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full sm:px-12 grid content-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="sm:flex justify-center space-x-4 space-y-4" x-data="{items: [
                {name: 'Financeiro', description: 'Cálculo de exames enviados para Sirius', link: '{{route('administrativo.financial')}}' },
                {name: 'RH', description: 'Gerenciar horas extras/faltosas', link:'{{route('administrativo.rh')}}'},
                {name: 'Patrimonial', description: 'Gerenciar patrimônio da empresa', link:''}
                ]}">
                    <template x-for="item in items">
                        <div class="bg-white w-48 h-36 rounded-lg shadow-md dark:bg-gray-800 p-2 space-y-2">
                            <span class="text-gray-700 dark:text-gray-50 font-semibold text-xl"
                                  x-text="item.name"></span>
                            <li class="text-gray-500 dark:text-gray-300 font-regular text-sm"
                                x-text="item.description"></li>
                            <div class="flex justify-end">
                                <a :href="item.link">
                                    <x-primary-button type="button">
                                        <x-icon name="external-link" class="w-4 h-4"></x-icon>
                                        Acessar
                                    </x-primary-button>
                                </a>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
@endsection
