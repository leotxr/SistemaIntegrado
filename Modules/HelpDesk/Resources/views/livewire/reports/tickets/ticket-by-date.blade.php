@section('content')
<div class="shadow-sm">
    <div class="max-w-full justify-items-center">
        <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4">
                <div class="p-2 bg-white shadow sm:p-4 dark:bg-gray-800 sm:rounded-lg">
                    <x-accordion>
                        <x-slot name="title">
                            <div class="text-gray-900 dark:text-white font-bold justify-start flex mx-2">
                                <x-icon name="filter" class="w-6 h-6"></x-icon>
                                <h1>Filtros<h1>
                            </div>
                        </x-slot>
                        <x-slot name="content">
                            <form wire:submit.prevent='render'>
                                @csrf
                                <div class="max-w-full">
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 content-center">
                                        <div>
                                            <label for="initial_date"
                                                class="label text-gray-900 dark:text-gray-50 font-light text-sm">Data
                                                inicial</label>
                                            <input type="date" wire:model='initial_date' id="initial_date"
                                                class="input border-gray-300 dark:bg-gray-800 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="final_date"
                                                class="label text-gray-900 dark:text-gray-50 font-light text-sm">Data
                                                Final</label>
                                            <input type="date" wire:model='final_date' id="final_date"
                                                class="input border-gray-300 dark:bg-gray-800 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="submit"
                                                class="label text-gray-900 dark:text-gray-50 font-light text-sm">Gerar
                                                relatório</label>
                                            <x-primary-button id="submit" type="submit">
                                                <x-icon name="search" class="w-6 h-6"></x-icon>
                                                <span>Buscar<span>
                                            </x-primary-button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </x-slot>
                    </x-accordion>

                </div>
                @foreach($tickets as $ticket)
                {{$ticket->id}}
                @endforeach


            </div>
        </div>
    </div>
</div>
@endsection