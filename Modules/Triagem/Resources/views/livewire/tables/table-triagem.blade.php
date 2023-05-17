<div>
    <div>
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
    </div>

    @isset($terms)
    <div class="h-full overflow-x-auto">
        <table class="table table-compact">
            <!-- head -->
            <thead>
                <tr>
                    <th>Ações</th>
                    <th>Data do Exame</th>
                    <th>Paciente</th>
                    <th>Procedimento</th>
                    <th>Contraste</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($terms as $key => $term)
                <tr>
                    <th class="dropdown dropdown-bottom">
                        <label tabindex="0" class="m-1 btn btn-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </label>
                        <ul tabindex="0"
                            class="absolute inline-block p-2 shadow dropdown-content menu bg-base-100 rounded-box w-52">
                            @if($term->signed != 1)
                            <li>
                                <form method="GET" action="{{ route('create.term-signature', ['id' => $term->id]) }}">
                                    @csrf
                                    <button type="submit">Assinar triagem</button>
                                </form>
                            </li>
                            @endif

                            <li>
                                <form method="POST" action="{{ route('create.term-file', ['id' => $term->id]) }}">
                                    @csrf
                                    <button type="submit">Adicionar Arquivos</button>
                                </form>
                            </li>

                            <li> <a href="{{ route('create.contraste', ['id'=>$term->id, 'sector' => $term->sector_id]) }}">Contraste</a>
                            </li>

                            <li>
                                <x-primary-button wire:click='editTerm({{$term->id}})'>Editar/Finalizar
                                </x-primary-button>
                            </li>
                        </ul>
                    </th>
                    <td>{{ $term->exam_date }}</td>
                    <td>{{ $term->patient_name }}</td>
                    <td>{{ $term->proced }}</td>
                    <td>
                        @if ($term->contrast == 1)
                        Sim
                        @else
                        Não
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{--MODAL--}}
    <x-modal.dialog wire:model.defer="modalTriagem">
        <x-slot name="title">
            <x-title>Triagem #{{$this->editing->id}} - {{$this->editing->patient_name}} </x-title>
        </x-slot>
        <x-slot name="content">
            <div class="flex p-2 mt-4 border border-dashed">


                <x-input-label for="start_hour" :value="__('Início')" class='ml-4 mr-2' />
                <x-text-input id="start_hour" name="start_hour" type="time" class="block w-1/3 mt-1"
                    wire:model='editing.start_hour' required readonly autocomplete="start_hour" />
                <x-input-error class="mt-2" :messages="$errors->get('start_hour')" />



                <x-input-label for="final_hour" :value="__('Fim')" class='ml-4 mr-2' />
                <x-text-input id="final_hour" name="final_hour" type="time" class="block w-1/3 mt-1"
                    wire:model='editing.final_hour' required readonly autocomplete="final_hour" />
                <x-input-error class="mt-2" :messages="$errors->get('final_hour')" />

            </div>

            <div class="my-4">
                <x-input-label for="observation" :value="__('Observações')" />
                <x-text-area id="observation" name="observation" type="text" wire:model='editing.observation' required
                    autofocus autocomplete="observation" />
                <x-input-error class="mt-2" :messages="$errors->get('observation')" />
            </div>

            @livewire('triagem::show-files', ['term' => $this->editing], key($this->editing->id))


        </x-slot>
        <x-slot name="footer">
            <div class="flex items-center">
                <form wire:submit.prevent='save({{$this->editing->id}})'>

                    <input id="default-checkbox" type="checkbox" value="1" wire:model.defer='editing.finished'
                        
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-checkbox" class="mx-2 text-sm font-bold text-gray-900 dark:text-gray-300">Marcar
                        como finalizada</label>

                    <x-secondary-button x-on:click="$dispatch('close')" class="mx-2">Cancelar</x-secondary-button>
                    <x-primary-button wire:model='btn_submit' type="submit">Salvar</x-primary-button>
            </div>
        </x-slot>
        </form>
    </x-modal.dialog>

    @endisset
</div>