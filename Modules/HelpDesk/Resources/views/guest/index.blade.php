@extends('helpdesk::layouts.guest')
@section('header')

<x-breadcrumb current>
</x-breadcrumb>

@endsection
@section('content')
<div class="m-4 shadow-sm">
    <div class="max-w-full px-12 justify-items-center">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                @livewire('helpdesk::guest.my-tickets')
            </div>
        </div>
    </div>
</div>
@endsection