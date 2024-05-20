@extends('helpdesk::layouts.master')
@section('header')
    <x-breadcrumb index="{{route('helpdesk.index')}}">
        <x-slot:page>
            <x-breadcrumb.page>Chamado #{{$ticket->id}}</x-breadcrumb.page>
        </x-slot:page>
    </x-breadcrumb>
@endsection
@section('content')
<div class="shadow-sm">
    <div class="max-w-full justify-items-center">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                @isset($ticket)
                @livewire('helpdesk::tickets.ticket-details', ['ticket' => $ticket])
                @endisset
            </div>
        </div>
    </div>
</div>
@endsection