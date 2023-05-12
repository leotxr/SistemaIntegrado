@extends('triagem::layouts.master')
@section('content')
    <div class="mb-24 border border-dashed">
        <form method="POST" action="{{ route('store.tomografia') }}">
            @csrf
            <div id="print" class="container">
                <div class="row">
                    <div class="p-5 col-12">
                        @livewire('triagem::term-header', ['paciente' => "$paciente->NOME", 'data_nascimento' => "$paciente->DATANASC", 'inicio_triagem' => "$start", 'data_exame' => '', 'procedimento' => "$paciente->DESCRICAO", 'pacienteid' => "$paciente->PACIENTEID"])

                    </div>

                    <div class="p-5 col-12">
                       @livewire('triagem::questionario-t-c')
                    </div>
                </div>

                <div class="p-5 col-12">
                    @livewire('triagem::term-footer', ['data_exame' => "$paciente->DATA", 'title' => 'Observação da Triagem', 'description' => '', 'img' => ''])
                </div>
    
            </div>

            @livewire('triagem::bottom-navigation', ['submit_title' => 'Salvar Questionario'])
        </form>
    </div>
    
   
@endsection
