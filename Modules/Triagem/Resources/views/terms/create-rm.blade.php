@extends('triagem::layouts.master')

@section('content')
@include('triagem::layouts.partials.modal-rm')
@include('triagem::layouts.partials.modal-tele-laudo')
    <div>
        <form method="POST" action="{{ url('triagem/terms') }}">
            @csrf
            <div id="termo-rm" class="container">
                <div class="row">
                    <div class="col-12 p-5">
                        @include('triagem::layouts.partials.cabecalho-rm')
                    </div>
                    <div class="col-12 p-5">
                        <livewire:triagem::components.termo-rm />
                    </div>
                    <div class="col-12 p-5">
                        <livewire:triagem::components.questionario-rm />
                    </div>
                    <div class="col-12 p-5">
                        @include('triagem::layouts.partials.rodape-rm')
                    </div>
                </div>
            </div>

            <div id="termo-tele-laudo" class="container">
                <div class="col-12 p-5">
                    <livewire:triagem::components.termo-tele-laudo />
                </div>
                <div class="col-12 p-5">
                    @include('triagem::layouts.partials.rodape-tele-laudo')
                </div>
            </div>

            <div class="grid justify-items-end p-12">
                <button wire:click="submit" type="submit" class="btn btn-primary rounded-sm">Enviar</button>
            </div>
        </form>
    </div>


@endsection
