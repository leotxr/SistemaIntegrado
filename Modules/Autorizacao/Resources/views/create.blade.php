@extends('autorizacao::layouts.master')
@section('header')

    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __("Nova Solicitação") }}
    </h2>

@endsection
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-50">Pedido</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-100">Insira as informações do pedido para autorização.
                                Caso seja uma autorização sem agendamento, marque a opção <b>Soliciatação sem Protocolo</b>.
                            </p>
                        </div>
                    </div>
                    <div class="form_busca mt-5 md:col-span-2 md:mt-0">

                        <div>
                            @livewire('autorizacao::forms.form-search')
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
