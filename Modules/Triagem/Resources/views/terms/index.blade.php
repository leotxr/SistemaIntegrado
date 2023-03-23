@extends('triagem::layouts.master')

@section('content')
    <div>
        <div class="py-4 px-2 border border-2 shadow-sm">
            <h1 class="text-gray-800 font-medium dark:text-gray-100 text-2xl">Triagens realizadas hoje</h1>
        </div>
        <div class="grid justify-items-center">
            <form method="GET" action="{{ url('triagem/terms/create') }}">
                @csrf
                <div class="grid sm:grid-cols-3 grid-cols-1 gap-2">
                    <div class="p-2 w-xs  mx-4">
                        <input type="number" class="input input-bordered input-primary w-full" name="paciente_id" value=""
                            placeholder="Código do paciente" />
                    </div>
                    <div class="p-2 mx-4">
                        <select name="procedimento" class="select select-bordered ">
                            <option disabled selected>Procedimento</option>
                            <option value="0">Ressonância</option>
                            <option value="1">Tomografia</option>
                        </select>
                    </div>
                    <div class="p-2">
                        <button type="submit" class="btn btn-primary">Nova Triagem</button>
                    </div>
                </div>
            </form>
            <div class="grid sm:justify-items-center m-2">
                @include('triagem::layouts.partials.tables.table-triagens-realizadas')
            </div>

        </div>
    </div>
@endsection
