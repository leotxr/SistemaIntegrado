@extends('helpdesk::layouts.guest')
@section('header')

    <x-breadcrumb index="{{route('helpdesk.guest.index')}}">
        <x-slot:page>
            <x-breadcrumb.page :current="true">#{{$ticket->id}} - {{$ticket->title}}</x-breadcrumb.page>
        </x-slot:page>
    </x-breadcrumb>

@endsection
@section('content')
    <div class="shadow-sm">
        <div class="max-w-full sm:px-4 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    @livewire('helpdesk::guest.show-ticket', ['ticket' => $ticket], key($ticket->id))
                </div>
            </div>
        </div>
    </div>
@endsection
