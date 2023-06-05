@extends('autorizacao::layouts.master')
@section('content')
@section('header')
<h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
    {{ __("Minhas Solicitações") }}
</h2>
@endsection

<div class="m-4 shadow-sm">
    <div class="max-w-full px-12 justify-items-center">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                @livewire('autorizacao::dashboard.my-requests')
            </div>
        </div>
    </div>
</div>

@endsection