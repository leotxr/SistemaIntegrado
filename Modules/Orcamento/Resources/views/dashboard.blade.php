@extends('orcamento::layouts.master')

@section('content')
<div class="py-4">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-gray-100 shadow-sm dark:bg-gray-900 sm:rounded-lg">
            @livewire('orcamento::dashboard.analytics')
        </div>
    </div>
</div>
@endsection