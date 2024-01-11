<div class="p-2">
    <form wire:submit.prevent="save">
        <div class="p-2 bg-white dark:bg-gray-800 shadow-sm rounded-lg">
            <x-title class="text-2xl font-extrabold dark:text-white flex space-x-2"><span><x-icon name="user-circle"
                                                                                                  class="w-8 h-8 text-blue-500 dark:text-blue-300"></x-icon> </span>{{$patient->PACIENTEID}}
                - {{$patient->NOME}}</x-title>
            <div class="grid grid-cols-2 sm:grid-cols-3">
                <p class="my-4 text-md text-gray-500">Nascimento: {{date('d/m/Y', strtotime($patient->DATANASC))}}</p>
                <p class="my-4 text-md font-normal text-gray-500 dark:text-gray-400">Inicio
                    Triagem: {{date('d/m/Y H:i:s', strtotime(now()))}}</p>
                <p class="my-4 text-md font-normal text-gray-500 dark:text-gray-400"></p>
            </div>
            <p class="my-4 text-md font-bold dark:text-white">Procedimento: {{$patient->DESCRICAO}}</p>
        </div>
        <x-table>
            <x-slot:head>
                <x-table.heading scope="col" class="px-6 py-3">
                    Questionário
                </x-table.heading>
                <x-table.heading scope="col" class="px-6 py-3">
                    Sim
                </x-table.heading>
                <x-table.heading scope="col" class="px-6 py-3">
                    Não
                </x-table.heading>
                <x-table.heading scope="col" class="px-6 py-3">
                    Observação
                </x-table.heading>
            </x-slot:head>

            <x-slot:body>
                @foreach ($questions as $index => $question)
                    <x-table.row>
                        <x-table.cell scope="row" name="pergunta"
                                      class="px-6 py-4 font-medium text-gray-900 whitespace-pre-line dark:text-white">
                            {{--<input type="text" name="perguntas[]" class="w-full input" readonly value="{{$value->description}}" wire:model.defer="question.description"
                                   />--}}
                            {{$question->question ?? ''}}
                        </x-table.cell>
                        <x-table.cell scope="row"
                                      class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <x-text-input id="question-{{$question->id}}" type="radio"
                                          value="Sim"
                                          wire:model.defer="questions.{{$index}}.answer" name="questions[{{$index}}]"
                                          class="w-4 h-4"/>
                        </x-table.cell>
                        <x-table.cell scope="row"
                                      class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <x-text-input id="question-{{$question->id}}" type="radio"
                                          value="Não"
                                          wire:model.defer="questions.{{$index}}.answer" name="questions[{{$index}}]"
                                          class="w-4 h-4"/>
                        </x-table.cell>
                        <x-table.cell scope="row"
                                      class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <input type="text" name="observacao" wire:model.defer="questions.{{$index}}.observation"
                                   class="w-full mt-2 input input-bordered" value=""/>
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot:body>
        </x-table>
        <div class="p-5 col-12">
            <div>
                <h2 class="text-xl font-extrabold dark:text-white p-2">Observação da Triagem</h2>
                <x-text-area wire:model.defer="observation"></x-text-area>
            </div>
        </div>
        @include('triagem::livewire.bottom-navigation')
    </form>
</div>
