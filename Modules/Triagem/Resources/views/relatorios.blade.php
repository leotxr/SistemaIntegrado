@extends('triagem::layouts.master')

@section('content')
    <div>
        <div class="py-4 px-2 border shadow-sm">
            <h1 class="text-gray-800 font-medium dark:text-gray-100 text-2xl">Relatório de Triagens Realizadas</h1>
        </div>
        <div class="grid justify-items-center my-4 border">
            <form method="GET" action="{{ route('relatorioTriagem') }}">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-3">
                    <div class="p-2 w-xs  mx-4">
                        <livewire:triagem::components.date-picker />
                    </div>
                    <div class="p-2 mx-4">
                        <label class="label text-sm" for="procedimento">Procedimento </label>
                        <select name="procedimento" class="select select-bordered ">
                            <option selected>Selecione</option>
                            <option value="RESSONANCIA">Ressonância</option>
                            <option value="1">Tomografia</option>
                        </select>
                    </div>
                    <div class="sm:py-10 py-2 mx-4">
                        <button type="submit" class="btn btn-info btn-wide">Buscar</button>
                    </div>

                </div>
            </form>
            <div class="grid sm:justify-items-center m-2">

            </div>

        </div>

        <div class="grid justify-items-center my-4 border">
            @include('triagem::layouts.partials.tables.table-relatorio-triagens')
        </div>
    </div>
@endsection
