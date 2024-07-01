@extends('helpdesk::layouts.guest')
@section('header')

    <x-breadcrumb index="{{route('helpdesk.guest.index')}}">
        <x-slot:page>
            <x-breadcrumb.page current>Nova Solicitação de serviço extra</x-breadcrumb.page>
        </x-slot:page>
    </x-breadcrumb>

@endsection
@section('content')
    <div class="m-4 shadow-sm">
        <div class="w-full px-12 justify-items-center">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    @livewire('helpdesk::guest.extra-service.form-create')
                </div>
            </div>
        </div>
    </div>
@endsection