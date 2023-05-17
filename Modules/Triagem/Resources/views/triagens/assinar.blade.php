@extends('triagem::layouts.master')
@section('content')
<div class="grid grid-cols-1 gap-4 p-2 sm:grid-cols-2">

    <div class="flex w-full p-2 bg-white shadow-md dark:bg-black">
        <form action="{{route('store.term-signature', ['id' => $term->id])}}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Capturar
                assinatura</label>
            <input name="signature_file"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="file_input" type="file">

            <x-primary-button type="submit" class="mt-2">Enviar</x-primary-button>

        </form>

    </div>
    {{--preview--}}
    <div>
        <div class="flex w-full p-2 bg-white shadow-md dark:bg-black">
            <div class="mt-5">
                @isset($path)
                <img src="{{URL::asset($path->url) }}" width='200px;'>
                @endisset

            </div>

        </div>
    </div>

</div>

@endsection