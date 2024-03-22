<div>
    <div wire:loading>
        @livewire('gestao::utils.loading-screen')
    </div>
    <div class="text-gray-800 dark:text-gray-100">
        <form wire:submit.prevent="searchInvoice">
            <div class="w-full bg-white dark:bg-gray-800 p-2 grid sm:grid-cols-6 grid-cols-2 gap-4">
                <div class="col-span-2 sm:col-span-2">
                    <x-input-label for="invoice">Código da Fatura (Exame)</x-input-label>
                    <x-text-input type="number" id="invoice" wire:model.defer="invoice_id" class="w-full"></x-text-input>
                    <x-input-error :messages="$errors->get('invoice_id')"></x-input-error>
                </div>
                <div class="mx-2 mt-4">
                    <x-primary-button type="submit" >Buscar</x-primary-button>
                </div>
            </div>
        </form>
        <div>
        </div>
    </div>
</div>

