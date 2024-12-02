@extends('triagem::layouts.master')
@section('content')
    @livewire('triagem::questionario.r-m-questionnaire', ['patient_id' => $paciente_id, 'sector_id' => $setor_id])
    {{--
    <div class="mb-24 border border-dashed">
        <form method="POST" action="{{ route('store.ressonancia') }}">
            @csrf
            <div id="print" class="container">
                <div class="row">
                    <div class="p-5 col-12">
                        @livewire('triagem::term-header', ['paciente' => "$paciente->NOME", 'data_nascimento' => "$paciente->DATANASC", 'inicio_triagem' => "$start", 'data_exame' => '', 'procedimento' => "$paciente->DESCRICAO", 'pacienteid' => "$paciente->PACIENTEID"])

                    </div>

                    <div class="p-5 col-12">
                        <livewire:triagem::questionario-r-m/>
                    </div>
                </div>
            </div>
            @include('triagem::livewire.bottom-navigation')
        </form>
    </div>
--}}
@endsection
