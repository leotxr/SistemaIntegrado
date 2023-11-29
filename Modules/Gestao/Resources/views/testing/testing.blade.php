@extends('gestao::layouts.master')
@section('content')
    <div class="m-2 shadow-sm">
        <div class="max-w-full px-12 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    @livewire('gestao::testing.test-query')
                </div>
            </div>
        </div>
    </div>
@endsection
