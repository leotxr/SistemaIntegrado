<div>
    <label for="arquivos" class="block text-sm font-medium leading-6 text-gray-900">Outros
        termos</label>
    <div class="flex">
        <div class="mx-2">
            <select wire:model='type_id' required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach($file_types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
        </div>
        <x-primary-button wire:click='generate({{$term->id}}, {{$type_id}})'>Gerar</x-primary-button>

    </div>

    @isset($generatingType)
    <x-modal.dialog wire:model.defer="modalFileGenerate">
        @csrf
        <x-slot name="title">
            <x-title>Gerar Documento: {{$generatingType->name}}</x-title>
            <p class="font-light text-sm text-gray-600 dark:text-gray-100">Certifique-se de conferir se as
                informações estão corretas antes de gerar o documento.</p>
        </x-slot>
        <x-slot name="content">
            <div class="p-2 mt-4 border border-dashed">
                <div>
                    <x-input-label for="patient_name" :value="__('Paciente')" />
                    <x-text-input id="patient_name" wire:model='generatingTerm.patient_name' type="text"
                        class="mt-1 block w-full" autocomplete="patient_name" />
                    <x-input-error :messages="$errors->updatePassword->get('patient_name')" class="mt-2" />
                </div>
                <div class="mt-2">
                    <x-input-label for="proced" :value="__('Exame')" />
                    <x-text-input id="proced" wire:model='generatingTerm.proced' type="text" class="mt-1 block w-full"
                        autocomplete="exam" />
                    <x-input-error :messages="$errors->updatePassword->get('proced')" class="mt-2" />
                </div>

            </div>
        </x-slot>
        <x-slot name="footer">
            <form wire:submit.prevent='save'>
                <div class="justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')" class="mx-2">Cancelar</x-secondary-button>
                    <x-primary-button type="submit">Gerar Documento</x-primary-button>
                </div>
            </form>
        </x-slot>

    </x-modal.dialog>
    @endisset
</div>