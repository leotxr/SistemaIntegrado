@extends('nc::layouts.master')
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full sm:px-12 px-4 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-left">
                    <ul x-data="{ reports: [
    { id: 1, label: 'Não Conformidades recebidas por setor', link: '{{route('nc.reports.received-by-sector')}}' },
    { id: 2, label: 'Totalizador de Não Conformidades por Funcionário' },
    { id: 3, label: 'Yellow' },
]}">
                        <template x-for="report in reports" :key="report.id">
                            <li><a class="space-x-2 cursor-pointer hover:border-b hover:border-b-blue-600 text-gray-600 dark:text-gray-50" type="button"
                                   :href="report.link"><span x-text="report.id" class="font-bold"></span>:<span
                                        x-text="report.label"></span></a></li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
