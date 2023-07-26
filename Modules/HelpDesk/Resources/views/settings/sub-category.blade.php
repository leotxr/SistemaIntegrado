@extends('helpdesk::layouts.master')
@section('header')

<h2 class="text-3xl font-semibold leading-tight text-gray-600 dark:text-gray-50">
    {{ __("Sub-Categorias") }}
</h2>

@endsection
@section('content')
<div class="mt-4 shadow-sm sm:m-4">
    <div class="max-w-full justify-items-center">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div>
                @livewire('helpdesk::settings.form-sub-category')
            </div>
        </div>
    </div>
</div>
@endsection