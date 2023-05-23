@extends('triagem::layouts.master')
@section('header')

<h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
    {{ __("#$triagem->patient_id - $triagem->patient_name - $triagem->proced") }}
</h2>

@endsection
@section('content')

<div class="m-4 shadow-sm">
    <div class="max-w-full p-12 space-y-12">
        <div class="grid grid-cols-1 gap-4 pb-12 border-b sm:grid-cols-2 border-gray-900/10">
            <div class="p-2 bg-white shadow-md dark:bg-black">
                <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Dados da triagem #{{
                    $triagem->id }}</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-50">Formulário para inserção de arquivos
                    referentes à
                    triagem
                    realizada.</p>

                <div class="pt-2">
                    <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Paciente:
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-50">{{ $triagem->patient_name }}</p>
                    <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Procedimento:
                    </h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-50">{{ $triagem->proced }}</p>
                </div>
            </div>

            <div class="p-2 bg-white shadow-md dark:bg-black">

                <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Termos da triagem #{{
                    $triagem->id }}</h2>
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                    <div class="">
                        @livewire('triagem::pdf-files', ['title' => 'Contraste', 'description' => 'Não Assinado', 'sign'
                        =>
                        $triagem->contrast_term, 'term' => $triagem, 'file_type' => 3,
                        'wire_function' => 'generate_pdf_contrast'])
                    </div>

                    <div class="">
                        @livewire('triagem::pdf-files', ['title' => 'Tele Laudo', 'description' => 'Não Assinado',
                        'sign' =>
                        $triagem->tele_report, 'term' => $triagem, 'file_type' => 2,
                        'wire_function' => 'generate_pdf_report'])
                    </div>

                   <div>
                    @livewire('triagem::generate-files', ['term' => $triagem], key($triagem->id) )
                   </div>
                </div>
            </div>
            <div class="p-2 bg-white shadow-md dark:bg-black">
                <div class="col-span-full">
                    @livewire('triagem::file-input', ['term' => $triagem], key($triagem->id))
                </div>
            </div>
            <div class="p-2 bg-white shadow-md dark:bg-black">
                <div class="col-span-full">
                    @livewire('triagem::show-files', ['term' => $triagem], key($triagem->id))
                </div>
            </div>

        </div>
    </div>
</div>

@endsection