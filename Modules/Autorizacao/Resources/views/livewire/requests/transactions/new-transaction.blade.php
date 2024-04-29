<div>
    <x-modal.dialog wire:model.defer="modalNewTransaction" maxWidth="lg">
        <x-slot:title>Transferência de exame</x-slot:title>
        <x-slot:content>
            @isset($target_exam)
                <div class="space-y-2">
                    <div class="border rounded-lg p-2">

                        @php
                            $exam_event = $target_exam->events->first();
                        @endphp
                        <dl>
                            <dd>
                                <x-title><span class="font-bold text-md">Paciente: </span><span
                                            class="font-semibold text-sm">{{$target_exam->protocol->paciente_name}}</span>
                                </x-title>
                            </dd>
                            <dd>
                                <x-title><span class="font-bold text-md">Exame: </span><span
                                            class="font-semibold text-sm">{{$target_exam->id}} - {{$target_exam->name}}</span>
                                </x-title>
                            </dd>
                            <dd>
                                <x-title><span class="font-bold text-md">Último evento: </span><span
                                            class="font-semibold text-sm uppercase">{{$exam_event->name}}</span>
                                </x-title>
                            </dd>
                            @if($exam_event->pivot->observation)
                                <dd>
                                    <x-title><span class="font-bold text-md">Observação: </span><span
                                                class="font-semibold text-sm uppercase">{{$exam_event->pivot->observation}}</span>
                                    </x-title>
                                </dd>
                            @endif
                        </dl>

                    </div>
                    <div class=" p-2 border rounded-lg">
                        <div class="w-full space-y-2">
                            <div>
                                <x-title class="font-bold text-lg">Novo Evento:</x-title>
                            </div>
                            @foreach($events->sortBy('order_to_show') as $event)
                                @if($event->id != $exam_event->id)
                                    <div>
                                        <div class="inline-flex space-x-2">
                                            <x-text-input id="event-{{$event->id}}" name="event" type="radio"
                                                          value="{{$event->id}}"
                                                          wire:model.defer="selected_event"></x-text-input>
                                            <x-input-label for="event-{{$event->id}}"
                                                           class="block text-sm font-medium text-gray-700">{{$event->name}}
                                            </x-input-label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div>
                                @error('selected_event')<span
                                        class="error font-semibold text-red-600">{{$message}}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class=" p-2 border rounded-lg">
                        <div>
                            <x-title class="font-bold text-lg">Observação:</x-title>
                        </div>
                        <div class="w-full">
                            <x-text-area wire:model.defer="observation"></x-text-area>
                        </div>
                    </div>
                </div>
            @endisset
        </x-slot:content>
        <x-slot:footer>
            <div class="space-x-2">
                <x-primary-button type="submit" wire:click="save">Salvar</x-primary-button>

                <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
            </div>
        </x-slot:footer>
    </x-modal.dialog>
</div>
