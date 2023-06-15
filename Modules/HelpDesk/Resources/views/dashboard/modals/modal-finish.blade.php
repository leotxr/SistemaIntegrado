@isset($finishing)
<x-modal.dialog wire:model.defer='modalFinish'>
    <x-slot name='title'>
        <x-title>Finalizar Chamado #{{$finishing->id}} - {{$finishing->title}}</x-title>
    </x-slot>
    <x-slot name='content'>
        <div>
            
        </div>
    </x-slot>
    <x-slot name='footer'>
    </x-slot>
</x-modal.dialog>
@endisset