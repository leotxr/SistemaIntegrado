@extends('nc::layouts.master')
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full sm:px-12 px-4 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                @livewire('nc::dashboard.index')
            </div>
        </div>
    </div>
@endsection
