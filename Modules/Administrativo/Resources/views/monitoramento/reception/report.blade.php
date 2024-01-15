@extends('administrativo::layouts.guest')
@section('header')

    <div>
        <x-dropdown align="left" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                    <div>Relatório Fila de Espera Recepção</div>

                    <div class="ml-1">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('adm.reception')"
                                 :active="request()->routeIs('adm.reception')">
                    {{ __('Fila de espera') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('adm.reception.report')"
                                 :active="request()->routeIs('adm.reception.report')">
                    {{ __('Relatório') }}
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>

@endsection
@section('content')

    @livewire('administrativo::monitoring.reception.report-reception-queue')


@endsection
