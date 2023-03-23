@extends('triagem::layouts.master')

@section('content')
    @php
        $files = $term->find($term->id)->relTermFiles;
    @endphp
    <div class="py-4 px-2 border">
        <h1 class="text-gray-800 font-medium dark:text-gray-100 text-2xl"><strong>Detalhes da Triagem</strong>
            #{{ $term->id }}</h1>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 py-4 px-2 shadow-sm">
        <div class="py-2">
            <h1 class="text-gray-800 font-medium dark:text-gray-100 text-xl"><strong>Paciente:</strong>
                {{ $term->patient_name }}</h1>
        </div>
        <div class="py-2">
            <h1 class="text-gray-800 font-medium dark:text-gray-100 text-xl"><strong>Código</strong> {{ $term->patient_id }}
            </h1>
        </div>
        <div class="py-2">
            <h1 class="text-gray-800 font-medium dark:text-gray-100 text-xl"><strong>Data do exame:</strong>
                {{ $term->exam_date }}
            </h1>
        </div>
        <div class="py-2">
            <h1 class="text-gray-800 font-medium dark:text-gray-100 text-xl"><strong>Procedimento:</strong>
                {{ $term->proced }}
            </h1>
        </div>
        <div class="py-2">
            <h1 class="text-gray-800 font-medium dark:text-gray-100 text-xl"><strong>Início/Fim:</strong>
                {{ $term->start_hour }} / {{ $term->final_hour }}
            </h1>
        </div>
        <div class="py-2">
            <h1 class="text-gray-800 font-medium dark:text-gray-100 text-xl"><strong>Tempo Gasto:</strong>
                {{ $term->time_spent }}
            </h1>
        </div>

    </div>

    <div>
        <div class="py-4 px-2">
            <h1 class="text-gray-800 font-medium dark:text-gray-100 text-xl">Arquivos anexados</h1>
        </div>
        <div class="grid grid-cols-5 gap-4 mx-2 content-end">
            @foreach ($files as $file)
            @php
            $file_type = $file->find($file->id)->relTypes;
            @endphp
                {{-- Termo --}}
                <div>
                    <div id="file" class="border">
                        <a href="{{ URL::asset($file->url) }}" class="" target="_blank">
                            <img class="h-auto max-w-full rounded-lg" src="{{ URL::asset($file->url) }}" >
                            <label for="file" class="label font-bold text-sm">
                            {{$file_type->name}}
                            </label>
                        </a>
                    </div>
                </div>

            @endforeach
        </div>
        <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
        
    </div>
@endsection
