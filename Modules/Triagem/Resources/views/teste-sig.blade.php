@extends('triagem::layouts.master')
@section('content')
<div class="flex p-2">
    <div class="border border-dashed bg-white">
        <livewire:triagem::signature-pad />
    </div>
    <div class="grid grid-cols-1 grid-rows-3 px-2">
        <button type="button" onclick="clearCanvas()"
            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Limpar</button>
        <button type="button" 
            class="text-white bg-blue-500 hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-800 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Gerar Termo Contraste</button>
        <button type="button" 
            class="text-white bg-blue-500 hover:bg-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-800 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Gerar Termo Tele-Laudo</button>
    </div>
</div>
@endsection