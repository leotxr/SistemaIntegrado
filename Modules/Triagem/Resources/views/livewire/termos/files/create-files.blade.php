<div>
    <div class="grid grid-cols-1 gap-4 pb-12 border-b sm:grid-cols-2 border-gray-900/10">
        <div class="p-2 bg-white shadow-md dark:bg-black">
            <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Dados da triagem #{{
                $triagem->id }}</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-50">Formulário para inserção de arquivos
                referentes à
                triagem
                realizada.</p>

            <div class="pt-2">
                <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Paciente:
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-50">{{ $triagem->patient_name }}</p>
                <h2 class="text-base font-semibold leading-7 text-gray-900 dark:text-white">Procedimento:
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-600 dark:text-gray-50">{{ $triagem->proced }}</p>
            </div>
        </div>

        <div class="p-2 bg-white shadow-md dark:bg-black">
            <div class="col-span-full">
                <div id="file_input">
                    <form wire:submit.prevent='save' enctype="multipart/form-data">
                        <div>
                            @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                            @endif
                        </div>

                        <label for="arquivos" class="block text-sm font-medium leading-6 text-gray-900">Adicionar
                            arquivos</label>
                        <div class="flex">
                            <div>
                                <input type="file" wire:model="photo"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="arquivo_help" accept="image/*;capture=camera" capture>
                            </div>

                            <div class="mx-2">
                                <select wire:model='type' required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Selecione Tipo</option>
                                    @foreach($file_type as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="m-2">
                            <x-primary-button type="submit">Salvar</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="p-2 bg-white shadow-md dark:bg-black">
            <div class="col-span-full">
                <div>
                    <h1 class="text-xl font-bold text-left">
                        Arquivos da triagem
                    </h1>
                    @isset($term_photos)
                    <div
                        class="grid gap-4 p-2 border border-dashed sm:grid-flow-col sm:auto-cols-max md:grid-cols-3 lg:grid-cols-2">
                        @foreach ($term_photos as $photo)
                        @php
                        $type = $photo->find($photo->id)->relTypes;
                        @endphp
                        <div>
                            <button wire:click='show({{$photo->id}})'>
                                <div class="relative">
                                    <img class="w-12 h-12 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                                        src="{{ URL::asset($photo->url) }}" />
                                    <label class="text-xs"> {{$type->name ?? ''}}</label>
                                </div>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    {{--MODAL--}}
                    <x-modal.dialog wire:model.defer="showModal">
                        <x-slot name="title">Imagem</x-slot>
                        <x-slot name="content">
                            <img src="{{URL::asset($showing_url)}}" class="max-h-fit max-w-screen" />
                        </x-slot>
                        <x-slot name="footer">
                            <x-secondary-button class="mx-2" x-on:click="$dispatch('close')">Cancelar
                            </x-secondary-button>
                            <a href="{{URL::asset($showing_url)}}" target="_blank">
                                <x-primary-button>Abrir em nova guia</x-primary-button>
                            </a>
                        </x-slot>
                    </x-modal.dialog>
                    @endisset
                    @empty($term_photos)
                    <p>Não existem arquivos da triagem atual...</p>
                    @endempty

                </div>
            </div>
        </div>

    </div>
</div>