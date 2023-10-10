<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    {{now()}}

                    @php
                    $data_inicio = new DateTime("2023-10-09 09:00:45");
                    $data_fim = new DateTime(now()->format('Y-m-d H:i:s'));

                    // Resgata diferença entre as datas
                    $dateInterval = $data_inicio->diff($data_fim);
                    echo $dateInterval->format('%d %H:%I:%S');
                    @endphp



                </div>
            </div>
        </div>
    </div>
</x-app-layout>