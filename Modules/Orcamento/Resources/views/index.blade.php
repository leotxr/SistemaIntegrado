@extends('orcamento::layouts.master')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                @livewire('orcamento::budget.show-budgets')
            </div>
        </div>
    </div>
</div>
@endsection