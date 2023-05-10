<div>
    <h1 class="text-xl font-bold text-left">
        Arquivos da triagem
    </h1>
    @isset($photos)
    <div class="grid gap-4 p-2 border border-dashed sm:grid-flow-col sm:auto-cols-max md:grid-cols-3 lg:grid-cols-2">
        @foreach ($photos as $photo)
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