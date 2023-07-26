@extends('helpdesk::layouts.master')

@section('content')
<div class="shadow-sm">
    <div class="max-w-full justify-items-center">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                @livewire('helpdesk::dashboard.dashboard')

            </div>
        </div>
    </div>
</div>
@endsection