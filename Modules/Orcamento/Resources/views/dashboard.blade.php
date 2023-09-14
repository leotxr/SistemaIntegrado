@extends('orcamento::layouts.master')

@section('content')
<div class="py-4">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-gray-100 shadow-sm dark:bg-gray-900 sm:rounded-lg">
            <div class="w-full p-2">
                @livewire('orcamento::dashboard.budget-stats')
            </div>
            <div class="grid grid-cols-1 gap-2 p-2 text-gray-900 dark:text-gray-100 sm:grid-cols-6 ">
                <div class="col-span-1 p-2 bg-white sm:col-span-3 dark:bg-gray-800">
                @livewire('orcamento::dashboard.budget-by-month')
                </div>
                <div class="col-span-1 p-2 bg-white sm:col-span-3 dark:bg-gray-800">
                    @livewire('orcamento::dashboard.top-users')
                </div>
                <div class="col-span-1 p-2 bg-white sm:col-span-5 dark:bg-gray-800">
                    @livewire('orcamento::dashboard.budget-by-day')
                </div>

            </div>
        </div>
    </div>
</div>
@endsection