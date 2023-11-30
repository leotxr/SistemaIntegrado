@extends('gestao::layouts.master')
@section('header')
    <x-breadcrumb>
        <a href="{{route('gestao.index')}}">
            Início
        </a>
        <x-slot name="page">
            <div x-data="{pages: [
        {id: 1, label: 'Laudo'}]}">
                <template x-for="page in pages" :key="page.id">
                    <x-breadcrumb.page>
                        <a x-text="page.label"></a>
                    </x-breadcrumb.page>
                </template>
            </div>
        </x-slot>
    </x-breadcrumb>
@endsection
@section('content')
    <div class="m-2 shadow-sm">
        <div class="max-w-full px-12 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg space-y-4">
                <div>
                    @livewire('gestao::laudo.analytics.pending-exams')
                </div>
            </div>
        </div>
    </div>
@endsection
