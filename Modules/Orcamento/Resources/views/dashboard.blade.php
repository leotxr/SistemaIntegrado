@extends('orcamento::layouts.master')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
            <div class="grid grid-cols-1 gap-4 p-6 text-gray-900 dark:text-gray-100 sm:grid-cols-6 ">
                <div class="col-span-1 sm:col-span-3">
                @livewire('orcamento::dashboard.budget-by-month')
                </div>
                <div class="col-span-1 sm:col-span-3">
                    @livewire('orcamento::dashboard.top-users')
                </div>
                <div class="col-span-1 sm:col-span-5">
                    @livewire('orcamento::dashboard.budget-by-day')
                </div>

            </div>
        </div>
    </div>
</div>
@endsection