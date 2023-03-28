@extends('helpdesk::layouts.master')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="chamados-pendentes">
            @include('helpdesk::layouts.guest.chamados.form-create-chamado')
        </div>
    </div>
</div>

@endsection