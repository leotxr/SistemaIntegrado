@extends('helpdesk::layouts.master')
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