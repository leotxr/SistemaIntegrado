@extends('helpdesk::layouts.master')
@section('header')

@endsection
@section('content')
<div class="shadow-sm">
    <div class="max-w-full justify-items-center">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4">

                <x-title class="dark:text-white text-2xl py-2">Relatórios</x-title>
                <ol class="max-w-md space-y-1 text-gray-500 list-decimal list-inside dark:text-gray-400">
                    <li>
                        <a href="{{route('helpdesk.reports.ticket-by-date')}}">
                            <span class="font-semibold text-gray-900 dark:text-white">Chamados por Período</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="font-semibold text-gray-900 dark:text-white">Chamados por Setor</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="font-semibold text-gray-900 dark:text-white">Tempo de atendimento</span>
                        </a>
                    </li>
                </ol>


            </div>
        </div>
    </div>
</div>
@endsection