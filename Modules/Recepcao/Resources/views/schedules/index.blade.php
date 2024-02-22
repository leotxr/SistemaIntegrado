@extends('recepcao::layouts.master')
@section('header')
    <x-title class="font-bold text-2xl">Buscar Livro</x-title>
@endsection
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full px-12 ">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-full">
                    @livewire('recepcao::schedules.search-book')
                </div>
            </div>
        </div>
    </div>
@endsection
