@extends('helpdesk::layouts.master')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <h1 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">Cadastros</h1>
        <div class="mb-4 shadow-md">
            @include('helpdesk::categorias.create')
        </div>
        <div class="mb-4 shadow-md">
            @include('helpdesk::setores.create')
        </div>
        <div class="mb-4 shadow-md">
            @include('helpdesk::status.create')
        </div>
    </div>
</div>
@endsection