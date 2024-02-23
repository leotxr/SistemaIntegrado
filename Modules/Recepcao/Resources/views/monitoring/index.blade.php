@extends('recepcao::layouts.master')
@section('content')
    <div class="m-4 shadow-sm">
        <div class="max-w-full px-12 ">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-full">
                    <div class="grid sm:grid-rows-4 grid-rows-1 gap-3">
                        <div class="sm:row-span-2 row-span-1">
                            <a href="{{url('/administrativo/monitoramento')}}">
                                <div class="p-2 bg-white dark:bg-gray-800 dark:text-gray-50 text-center rounded-lg">
                                    Painel de monitoramento Livros
                                </div>
                            </a>
                        </div>
                        <div class="sm:row-span-2 row-span-1">
                            <a href="{{url('/administrativo/recepcao/fila-de-espera')}}">
                                <div class="p-2 bg-white dark:bg-gray-800 dark:text-gray-50 text-center rounded-lg">
                                    Fila de Espera Recepção
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
