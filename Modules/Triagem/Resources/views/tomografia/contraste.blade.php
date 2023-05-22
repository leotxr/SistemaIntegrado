@extends('triagem::layouts.master')
@section('content')
    <div class="mb-24 border border-dashed">
        <form method="POST" action="{{ route('store.contraste', ['id' => $termo->id]) }}">
            @csrf
            <div id="print" class="container">
                <div class="row">
                    <div class="p-5 col-12">
                        @livewire('triagem::term-header', ['paciente' => "$termo->patient_name", 'data_nascimento' => "$termo->patient_age", 'inicio_triagem' => '', 'data_exame' => '', 'procedimento' => "$termo->proced", 'pacienteid' => "$termo->patient_id"])

                    </div>

                    <div class="p-5">
                        <livewire:triagem::questionario-contraste-tomografia />
                    </div>
                </div>

                <div class="p-5 col-12">
                    @livewire('triagem::contrast-footer', ['data_exame' => "$termo->exam_date", 'title' => 'Assinaturas do médico e Enfemeiro(a) responsáveis', 'medico' => ''])
                </div>

            </div>

            @livewire('triagem::bottom-navigation', ['submit_title' => 'Salvar Questionario'])
        </form>
    </div>
@endsection
