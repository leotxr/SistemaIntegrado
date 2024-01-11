<div class="justify-center">
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white font-medium p-2 rounded-md shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/>
        </svg>
        <h1>Filtros</h1>

        <div class="grid sm:grid-cols-3 grid-cols-1 gap-4">

            <div class="flex items-center mb-4">
                <input id="em-aberto" type="checkbox" value="0" checked wire:model='status_triagem'
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="em-aberto" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mostrar
                    triagens em aberto</label>
            </div>
            <div class="flex items-center mb-4">
                <input id="finalizadas" type="checkbox" value="1" wire:model='status_triagem'
                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="finalizadas" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mostrar
                    triagens finalizadas</label>
            </div>
            <div>
                <p class="text-gray-600 text-xs">Última atualização em:</p>
                <p class="text-gray-600 text-sm">{{now()}}</p>
            </div>
        </div>
    </div>

    @isset($terms)
        <div class="w-full mt-2" wire:poll.60000ms>
            <x-table>
                <x-slot:head>
                    <x-table.heading>Ações</x-table.heading>
                    <x-table.heading>Data</x-table.heading>
                    <x-table.heading>Hora</x-table.heading>
                    <x-table.heading>Paciente</x-table.heading>
                    <x-table.heading>Procedimento</x-table.heading>
                    <x-table.heading>Status</x-table.heading>
                </x-slot:head>
                <x-slot:body>
                    @foreach ($terms as $key => $term)
                        <x-table.row>
                            <x-table.cell>
                                <a type="button" class="cursor-pointer" wire:click='editTerm({{$term->id}})'>
                                    <x-icon name="pencil-alt" class="w-8 h-8"></x-icon>
                                </a>
                            </x-table.cell>
                            <x-table.cell>{{ date('d/m/Y', strtotime($term->exam_date)) }}</x-table.cell>
                            <x-table.cell>{{ date('H:i:s', strtotime($term->created_at)) }}</x-table.cell>
                            <x-table.cell>{{ $term->patient_name }}</x-table.cell>
                            <x-table.cell>{{ $term->proced }}</x-table.cell>
                            <x-table.cell>
                                @if ($term->finished == 1)
                                    <span
                                        class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-blue-800 bg-blue-100 rounded dark:bg-blue-900 dark:text-blue-300">Finalizada</span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2 py-1 me-2 text-sm font-medium text-yellow-800 bg-yellow-100 rounded dark:bg-yellow-900 dark:text-yellow-300">Em aberto</span>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                    {{ $terms->links() }}
                </x-slot:body>
            </x-table>
        </div>
        {{--MODAL--}}
        <x-modal.dialog wire:model.defer="modalTriagem">
            <x-slot name="title">
                <x-title>Triagem #{{$this->editing->id}} - {{$this->editing->patient_name}} </x-title>
            </x-slot>
            <x-slot name="content">
                <div class="flex p-2 mt-4 border border-dashed">


                    <x-input-label for="start_hour" :value="__('Início')" class='ml-4 mr-2'/>
                    <x-text-input id="start_hour" name="start_hour" type="time" class="block w-1/3 mt-1"
                                  wire:model='editing.start_hour' required readonly autocomplete="start_hour"/>
                    <x-input-error class="mt-2" :messages="$errors->get('editing.start_hour')"/>


                    <x-input-label for="final_hour" :value="__('Fim')" class='ml-4 mr-2'/>
                    <x-text-input id="final_hour" name="final_hour" type="time" class="block w-1/3 mt-1"
                                  wire:model='editing.final_hour' required readonly autocomplete="final_hour"/>
                    <x-input-error class="mt-2" :messages="$errors->get('editing.final_hour')"/>

                </div>

                <div class="my-4">
                    <x-input-label for="observation" :value="__('Observações')"/>
                    <x-text-area id="observation" name="observation" type="text" wire:model='editing.observation'
                                 required
                                 autofocus autocomplete="observation"/>
                    <x-input-error class="mt-2" :messages="$errors->get('editing.observation')"/>
                </div>

                @livewire('triagem::show-files', ['term' => $this->editing], key($this->editing->id))


            </x-slot>
            <x-slot name="footer">

                <form wire:submit.prevent='save({{$this->editing->id}})'>
                    <div class="flex items-center">
                        <input id="default-checkbox" type="checkbox" value="1" wire:model.defer='editing.finished'
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="default-checkbox" class="mx-2 text-sm font-bold text-gray-900 dark:text-gray-300">Marcar
                            como finalizada</label>

                        <x-secondary-button x-on:click="$dispatch('close')" class="mx-2">Cancelar</x-secondary-button>
                        <x-primary-button wire:model='btn_submit' type="submit">Salvar</x-primary-button>
                    </div>
                </form>
            </x-slot>

        </x-modal.dialog>

    @endisset
</div>
