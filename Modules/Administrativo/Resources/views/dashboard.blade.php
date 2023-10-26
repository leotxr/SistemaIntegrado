@extends('administrativo::layouts.master')
@section('header')
    <a type="button" href="/">
<x-icon name="home" class="w-8 h-8 text-gray-500 hover:text-gray-800 cursor-pointer" solid />
    </a>
@endsection
@section('content')
<div class="py-4">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8">
        @livewire('administrativo::monitoring.dashboard.menu')
    </div>
</div>
@endsection
