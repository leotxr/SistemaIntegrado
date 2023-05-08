@extends('triagem::layouts.master')
@section('content')
    <div class="border border-dashed mb-24">
        <form method="POST" action="{{ route('store.tomografia') }}">
            @csrf
            <div id="print" class="container">
                <div class="row">
                    <div class="col-12 p-5">
                        @livewire('triagem::term-header', ['paciente' => "$paciente->NOME", 'data_nascimento' => "$paciente->DATANASC", 'inicio_triagem' => "$start", 'data_exame' => '', 'procedimento' => "$paciente->DESCRICAO", 'pacienteid' => "$paciente->PACIENTEID"])

                    </div>

                    <div class="col-12 p-5">
                        <livewire:triagem::questionario-r-m />
                    </div>
                </div>

                <div class="col-12 p-5">
                    @livewire('triagem::term-footer', ['data_exame' => "$paciente->DATA", 'title' => 'Observação da Triagem', 'description' => '', 'img' => ''])
                </div>
    
            </div>

            @livewire('triagem::bottom-navigation', ['submit_title' => 'Salvar Questionario'])
        </form>
    </div>
    
   
@endsection
