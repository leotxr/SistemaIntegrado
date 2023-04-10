@extends('triagem::layouts.master')
@section('content')
    <div class="border border-dashed mb-24">
        <form method="POST" action="{{ route('store.ressonancia') }}">
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
                    @livewire('triagem::term-footer', ['data_exame' => "$paciente->DATA", 'title' => 'Assinatura do titular ou responsável', 'description' => '', 'img' => ''])
                </div>
    
            </div>
            {{--
            <button wire:click="submit" type="submit"
                class="fixed z-90 bottom-10 right-8 bg-blue-600 w-16 h-16 rounded-full drop-shadow-lg flex justify-center items-center text-white text-4xl hover:bg-blue-700 hover:drop-shadow-2xl active:scale-50 duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-save w-6 h-6" viewBox="0 0 16 16">
                    <path
                        d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z" />
                </svg>
            </button>
            --}}
            @livewire('triagem::bottom-navigation', ['submit_title' => 'Salvar Questionario'])
        </form>
    </div>
    
    @livewire('triagem::modal-signature', ['title' => 'Assinatura do Titular ou Responsável'])
@endsection
