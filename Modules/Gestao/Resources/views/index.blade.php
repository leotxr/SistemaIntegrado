@extends('gestao::layouts.master')
@section('header')
    <x-breadcrumb>
        <a href="{{route('gestao.index')}}">
            Início
        </a>
        <x-slot name="page">
        </x-slot>
    </x-breadcrumb>
@endsection
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full px-12 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div>
teste
                </div>
            </div>
        </div>
    </div>
@endsection
