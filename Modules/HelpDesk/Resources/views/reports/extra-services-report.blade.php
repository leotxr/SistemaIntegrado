@extends('helpdesk::layouts.master')
@section('content')
<div class="mt-4 shadow-sm sm:m-4">
    <div class="max-w-full justify-items-center">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                @livewire('helpdesk::reports.extra-services.extra-services-report')
            </div>
        </div>
    </div>
</div>
@endsection