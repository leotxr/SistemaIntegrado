@extends('helpdesk::layouts.guest')

@section('content')
<div class="p-4">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 bg-base-200">
        <div class="grid grid-cols-1 sm:grid-cols-1 gap-2 place-items-center dark:bg-gray-800">
            @include('helpdesk::layouts.guest.chamados.form-create-chamado')
        </div>
    </div>
</div>
@endsection