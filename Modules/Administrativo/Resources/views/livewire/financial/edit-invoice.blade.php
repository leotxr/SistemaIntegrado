<div>
    <form wire:submit.prevent="save">
        <x-modal.dialog wire:model.defer="modalEdit">
            <x-slot:title>Editar Fatura</x-slot:title>
            <x-slot:content>
                @isset($editing_invoice)
                    <div class="p-2">
                        <div class="inline-flex space-x-2">
                            <label for="payment_enable">Pagamento</label>
                            <input type="checkbox" name="payment_enable" id="payment_enable"
                                          wire:model.defer="editing_invoice.payment_enable"/>
                        </div>
                    </div>
                @endisset
            </x-slot:content>
            <x-slot:footer>
                <div class="inline-flex space-x-2">
                    <x-secondary-button x-on:click="$dispatch('close')">Fechar</x-secondary-button>
                    <x-primary-button type="submit">Salvar</x-primary-button>
                </div>
            </x-slot:footer>
        </x-modal.dialog>
    </form>
</div>
