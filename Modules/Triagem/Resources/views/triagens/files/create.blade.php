@extends('triagem::layouts.master')
@section('content')

<div class="bg-white dark:bg-black shadow-sm m-4">
    <div class="space-y-12 max-w-2xl p-12">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Arquivos da triagem #{{ $triagem->id }}</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Formulário para inserção de arquivos referentes à
                triagem
                realizada.</p>

            <div class="pt-2">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Paciente:
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">{{ $triagem->patient_name }}</p>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Procedimento:
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">{{ $triagem->proced }}</p>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">


                <div class="col-span-full">
                    @livewire('triagem::pdf-files', ['title' => 'Contraste', 'description' => 'Gerar termo de
                    Contraste assinado', 'sign' => $triagem->contrast_term, 'term' => $triagem, 'file_type' => 3,
                    'wire_function' => 'generate_pdf_contrast'])
                </div>

                <div class="col-span-full">
                    @livewire('triagem::pdf-files', ['title' => 'Tele Laudo', 'description' => 'Gerar termo de Tele
                    Laudo assinado', 'sign' => $triagem->tele_report, 'term' => $triagem, 'file_type' => 2,
                    'wire_function' => 'generate_pdf_report'])
                </div>

                <div class="col-span-full">
                    @livewire('triagem::file-input', ['term' => $triagem], key($triagem->id))
                </div>

                <div class="col-span-full">
                    @livewire('triagem::show-files', ['term' => $triagem], key($triagem->id))
                </div>

            </div>
        </div>
    </div>

    @endsection