<div>
    <h1 class="text-xl font-bold text-left">
        Arquivos da triagem
    </h1>
    @isset($photos)
        <div class="p-2 border border-dashed">
            <div
                class="grid gap-2 grid-cols-8 w-full">
                @foreach ($photos as $photo)
                    @php
                        $type = $photo->find($photo->id)->relTypes;
                    @endphp
                    <div class="col-span-2">
                        <button wire:click='show({{$photo->id}})'>
                            <div class="relative">
                                <img class="w-12 h-12 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                                     src="{{ URL::asset($photo->url) }}"/>
                                <label class="text-xs"> {{$type->name ?? ''}}</label>
                            </div>
                        </button>
                    </div>
                @endforeach
                <div class="col-span-1 justify-end">
                    <a href="{{url('/triagem/' . $term->id . '/files/create')}}">
                    <x-primary-button type="button" class="rounded-full">
                        <x-icon name="plus" class="w-6 h-6"></x-icon>
                    </x-primary-button>
                    </a>
                </div>
            </div>

        </div>
        {{--MODAL--}}
        <x-modal.dialog wire:model.defer="showModal">
            <x-slot name="title">Imagem</x-slot>
            <x-slot name="content">
                <img src="{{URL::asset($showing_url)}}" class="max-h-fit max-w-screen" alt="imagem"/>
            </x-slot>
            <x-slot name="footer">
                <x-secondary-button class="mx-2" x-on:click="$dispatch('close')">Cancelar</x-secondary-button>
                <a href="{{URL::asset($showing_url)}}" target="_blank">
                    <x-primary-button>Abrir em nova guia</x-primary-button>
                </a>
            </x-slot>
        </x-modal.dialog>
    @endisset
    @empty($photos)
        <p>Não existem arquivos da triagem atual...</p>
    @endempty

</div>
