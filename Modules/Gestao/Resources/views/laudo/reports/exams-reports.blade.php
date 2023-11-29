@extends('gestao::layouts.master')
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full px-12 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    @livewire('gestao::laudo.analytics.exams-without-report')
                </div>
            </div>
        </div>
    </div>
@endsection
