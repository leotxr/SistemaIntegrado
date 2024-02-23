<div>
    <div wire:loading>
        @livewire('gestao::utils.loading-screen')
    </div>
<div class="text-gray-800 dark:text-gray-100">
    <form wire:submit.prevent="search">
        <div class="w-full bg-white dark:bg-gray-800 p-2 grid sm:grid-cols-6 grid-cols-2 gap-4">
            <div class="col-span-2 sm:col-span-2">
                <x-input-label for="book">Livro</x-input-label>
                <x-select id="book" class="w-full" wire:model.defer="selected_book">
                    <x-slot name="option">
                        <x-select.option value="0">Selecione o livro</x-select.option>
                    @foreach($books as $book)
                            <x-select.option value="{{$book->LIVROID}}">{{$book->DESCRICAO}}</x-select.option>
                        @endforeach
                    </x-slot>
                </x-select>
            </div>
            <div class="col-span-2 sm:col-span-2">
                <x-input-label for="date">Data</x-input-label>
                <x-text-input type="date" id="date" wire:model.defer="date" class="w-full"></x-text-input>
            </div>
            <div class="col-span-2 sm:col-span-2 p-4">
                <x-primary-button type="submit" class="w-1/2">Buscar</x-primary-button>
            </div>
        </div>
    </form>
    <div>
        {{$patients->links()}}
        <x-table>
            <x-slot:head>
                <x-table.heading>Data</x-table.heading>
                <x-table.heading>ID Paciente</x-table.heading>
                <x-table.heading>Paciente</x-table.heading>
                <x-table.heading>Livro</x-table.heading>
            </x-slot:head>
            <x-slot:body>
                @foreach($patients as $patient)
                    <x-table.row class="cursor-pointer" wire:click="getExams({{$patient->PACIENTEID}}, '{{$patient->NOMEPAC}}')">
                        <x-table.cell>{{date('d/m/Y', strtotime($patient->DATA))}}</x-table.cell>
                        <x-table.cell>{{$patient->PACIENTEID}}</x-table.cell>
                        <x-table.cell>{{$patient->NOMEPAC}}</x-table.cell>
                        <x-table.cell>{{$patient->LIVRODESC}}</x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot:body>
        </x-table>
        {{$patients->links()}}
    </div>
</div>
    @livewire('recepcao::schedules.show-exams')
</div>
