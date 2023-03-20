@extends('triagem::layouts.master')

@section('content')
    <div class="grid text-center p-5 shadow-md justify-items-center w-xl">

        <div id="titulo">
            <h1 class="text-3xl font-bold text-gray-800 my-4"> Adicionar arquivos à Triagem </h1>
            <h4 class="text-md font-bold text-gray-800" name="term_id" value="{{ $triagem->id }}"> Triagem:
                #{{ $triagem->id }} </h4>
            <h4 class="text-md font-bold text-gray-800 mb-4" name="patient_name" value="{{ $triagem->patient_name }}">
                Paciente: {{ $triagem->patient_name }} </h4>
        </div>

        <form method="POST" action="{{ url('triagem/terms/files') }}" enctype="multipart/form-data">
            @csrf
            <input class="text-md font-bold text-gray-800" name="term_id" value="{{ $triagem->id }}" hidden/>
            <input class="text-md font-bold text-gray-800 mb-4" name="patient_name" value="{{ $triagem->patient_name }}" hidden />
            
            <div class="grid grid-rows-1 sm:grid-rows-1 gap-2" id="upload">
                <div class="flex">
                    <input type="file" name="files[]" id="files"
                        class="file-input file-input-bordered w-full max-w-lg mb-4" multiple />
                    <a type="button" onclick="addinput()" class="btn btn-info ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </a>
                </div>
            </div>
            <div id="enviar">
                <button type="submit" class="btn btn-info" name="btn-enviar">Enviar</button>
            </div>
        </form>
    </div>
@endsection


<script>
    function addinput() {
        var card = document.createElement("div");
        card.innerHTML =
            '<input type="file" name="files[]" id="files" class="file-input file-input-bordered w-full max-w-lg mb-4" />';
        var element = document.getElementById("upload");
        element.appendChild(card);

    }
</script>
