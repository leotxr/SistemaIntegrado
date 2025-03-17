@extends('helpdesk::layouts.master')
@section('content')
<div class="mt-4 shadow-sm sm:m-4">
    <div class="max-w-full justify-items-center">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <form >
                @csrf
                <div class="p-2 bg-white shadow sm:p-4 dark:bg-gray-800 sm:rounded-lg">
                    <x-accordion>
                        <x-slot name="title">
                            <div class="flex justify-start mx-2 font-bold text-gray-900 dark:text-white">
                                <x-icon name="filter" class="w-6 h-6"></x-icon>
                                <h1>Filtros<h1>
                            </div>
                        </x-slot>
                        <x-slot name="content">
                            <div class="max-w-full">
                                <div class="grid content-center grid-cols-2 gap-4 sm:grid-cols-4">
                                    <div>
                                        <label for="initial_date"
                                            class="text-sm font-light text-gray-900 label dark:text-gray-50">Data
                                            inicial</label>
                                        <input type="date"  id="initial_date"
                                            class="border-gray-300 input dark:bg-gray-800 dark:text-white">
                                    </div>
                                    <div>
                                        <label for="final_date"
                                            class="text-sm font-light text-gray-900 label dark:text-gray-50">Data
                                            Final</label>
                                        <input type="date"  id="final_date"
                                            class="border-gray-300 input dark:bg-gray-800 dark:text-white">
                                    </div>
                                    <div>
                                        <label for="submit"
                                            class="text-sm font-light text-gray-900 label dark:text-gray-50">Gerar
                                            relatório</label>
                                        <x-primary-button id="submit" type="submit">
                                            <x-icon name="search" class="w-6 h-6"></x-icon>
                                            <span>Buscar<span>
                                        </x-primary-button>

                                    </div>
                                    <div>
                                        <label for="excel"
                                            class="text-sm font-light text-gray-900 label dark:text-gray-50">Gerar
                                            relatório</label>
                                        <x-secondary-button id="excel" type="button">
                                            <x-icon name="document" class="w-6 h-6"></x-icon>
                                            Exportar
                                        </x-secondary-button>
                                    </div>
                                </div>
                            </div>

                        </x-slot>
                    </x-accordion>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection