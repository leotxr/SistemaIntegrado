@extends('helpdesk::layouts.master')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
        <div class="chamados-pendentes">
            @include('helpdesk::layouts.partials.painel.chamados-pendentes')
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            @include('helpdesk::layouts.partials.painel.stats.tma')
            @include('helpdesk::layouts.partials.painel.stats.tme')
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            @include('helpdesk::layouts.partials.painel.stats.qap')
        </div>

        <div class="horarios-pico-chamados">
            @include('helpdesk::layouts.partials.painel.stats.hpac')

        </div>
    </div>
</div>
@endsection