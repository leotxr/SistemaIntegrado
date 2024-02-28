@extends('laudo::layouts.master')
@section('header')
    <x-breadcrumb>
        <a href="{{route('laudo.index')}}">
            Início
        </a>
        <x-slot name="page">
            <x-breadcrumb.page>Laudo</x-breadcrumb.page>
            <x-breadcrumb.page current>Relatórios</x-breadcrumb.page>
        </x-slot>
    </x-breadcrumb>
@endsection
@section('content')
    <div class="m-2 shadow-sm">
        <div class="max-w-full px-12 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg space-y-4">
                <div>
                    <x-ordered-list>
                        Relatórios:
                        <x-slot name="items">
                            <div x-data="{items: [
                            {id: 1, label: 'Exames sem Laudar', url:'{{route('laudo.reports.exams-without-report')}}'},
                            {id: 2, label: 'Exames sem Assinar', url:'{{route('laudo.reports.exams-without-signature')}}'},
                            {id: 3, label: 'Exames pendentes de Revisão', url:'{{route('laudo.reports.exams-to-review')}}'},
                            {id: 4, label: 'Exames sem médico vinculado', url:'{{route('laudo.reports.exams-without-doctor')}}'},
                            ]}">
                                <template x-for="item in items" :key="item.id">
                                    <x-ordered-list.item>
                                        <a x-text="item.label" :href="item.url" class="hover:text-blue-800"></a>
                                    </x-ordered-list.item>
                                </template>

                            </div>

                        </x-slot>
                    </x-ordered-list>
                </div>
            </div>
        </div>
    </div>
@endsection
