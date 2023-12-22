@extends('nc::layouts.master')
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full px-12 ">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-full">
                   @livewire('nc::user.dashboard')
                </div>
            </div>
        </div>
    </div>
@endsection
