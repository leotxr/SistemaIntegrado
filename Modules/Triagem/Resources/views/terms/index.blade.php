@extends('triagem::layouts.master')

@section('content')
    <div class="p-5 shadow-md rounded-md bg-white grid justify-items-center">
        <div class="bg-white shadow-md rounded-md">
            <form method="GET" action="{{ url('triagem/terms/create') }}" >
                @csrf
                <div class="grid grid-cols-3 sm:grid-cols-3 gap-2 text-center">
                    <div class="p-2">
                        <input type="number" class="input input-bordered input-primary" name="paciente_id" value=""
                            placeholder="Código do paciente" />
                    </div>
                    <div class="p-2">
                        <select name="procedimento" class="select select-bordered w-full max-w-sm">
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
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Paciente</th>
                            <th>Procedimento</th>
                            <th>Contraste</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($terms as $term)
                            <tr>
                                <th></th>
                                <td>{{ $term->patient_name }}</td>
                                <td>{{ $term->proced }}</td>
                                <td>
                                    @if ($term->contrast == 1)
                                        Sim
                                    @else
                                        Não
                                    @endif
                                </td>
                                <td class="flex">
                                    <!--<label id="btn-edit" data-value="{{ $term->id }}" for="my-modal-6">Editar</label>-->
                                    <a href="{{ url("triagem/terms/$term->id/edit") }}" class="btn btn-primary mx-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="bi bi-capsule w-6 h-6" viewBox="0 0 16 16">
                                            <path
                                                d="M1.828 8.9 8.9 1.827a4 4 0 1 1 5.657 5.657l-7.07 7.071A4 4 0 1 1 1.827 8.9Zm9.128.771 2.893-2.893a3 3 0 1 0-4.243-4.242L6.713 5.429l4.243 4.242Z" />
                                        </svg>
                                    </a>
                                    <form action="{{ url('triagem/terms/' . $term->id) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <button type="submit" for="my-modal-6" class="btn btn-error mx-2 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
