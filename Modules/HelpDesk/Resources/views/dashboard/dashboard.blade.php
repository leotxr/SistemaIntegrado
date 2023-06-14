@extends('helpdesk::layouts.master')
@section('header')

<h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
    {{ __("Nova Solicitação") }}
</h2>

@endsection
@section('content')
<div class="m-4 shadow-sm">
    <div class="max-w-full px-6 justify-items-center">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                @livewire('helpdesk::dashboard.ticket-tabs')

            </div>
        </div>
    </div>
</div>
@endsection