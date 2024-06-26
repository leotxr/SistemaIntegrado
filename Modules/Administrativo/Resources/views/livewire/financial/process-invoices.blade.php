<div class="space-y-2">
    <div class="p-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-2">
        <div class="sm:flex items-center space-x-2 p-2">
            <div>
                <x-input-label for="doctor_id" :value="__('Selecionar Médico')"
                               class="text-lg font-bold"/>
                <x-select name='doctor_id' id="doctor_id" wire:model.defer="selected_doctor"
                          class="w-24 sm:w-96">
                    <x-slot name='option'>
                        <option selected> Selecione</option>
                        @foreach($doctors as $doctor)
                            <x-select.option value="{{$doctor->id}}">
                                {{$doctor->name}}
                            </x-select.option>
                        @endforeach
                    </x-slot>
                </x-select>
                <x-input-error class="mt-2" :messages="$errors->get('selected_doctor')"/>
            </div>
            <div>
                <x-input-label for="start_date" :value="__('Data Inicial')"
                               class="text-lg font-bold"/>
                <x-text-input type="date" id="start_date" name="start_date" wire:model="start_date"></x-text-input>
                <x-input-error class="mt-2" :messages="$errors->get('start_date')"/>
            </div>
            <div>
                <x-input-label for="end_date" :value="__('Data Final')"
                               class="text-lg font-bold"/>
                <x-text-input type="date" id="end_date" name="end_date" wire:model="end_date"></x-text-input>
                <x-input-error class="mt-2" :messages="$errors->get('end_date')"/>
            </div>
            <div>
                <x-primary-button wire:click="$refresh">Buscar</x-primary-button>
            </div>
        </div>
        <div>
            <div class="max-h-64 overflow-auto">
                <x-table>
                    <x-slot name="head">
                        <x-table.heading>Editar</x-table.heading>
                        <x-table.heading>Data Exame</x-table.heading>
                        <x-table.heading>Fatura</x-table.heading>
                        <x-table.heading>ID Paciente</x-table.heading>
                        <x-table.heading>Nome Paciente</x-table.heading>
                        <x-table.heading>Exame</x-table.heading>
                        <x-table.heading>Convênio</x-table.heading>
                        <x-table.heading>Valor Total</x-table.heading>
                        <x-table.heading>Processado</x-table.heading>
                    </x-slot>
                    <x-slot name="body">
                        @foreach($invoices as $invoice)
                            <x-table.row>
                                <x-table.cell>
                                    <button wire:click="$emit('editInvoice', {{$invoice->id}})"
                                            class="text-blue-800 dark:text-blue-300 font-bold inline-flex"
                                            type="submit">
                                        <x-icon name="pencil-alt" class="w-6 h-6"></x-icon>
                                    </button>
                                </x-table.cell>
                                <x-table.cell>{{date('d/m/y', strtotime($invoice->exam_date))}}</x-table.cell>
                                <x-table.cell>{{$invoice->invoice_id}}</x-table.cell>
                                <x-table.cell>{{$invoice->patient_id}}</x-table.cell>
                                <x-table.cell>{{$invoice->patient_name}}</x-table.cell>
                                <x-table.cell>{{$invoice->exam_description}}</x-table.cell>
                                <x-table.cell>{{$invoice->insurance}}</x-table.cell>
                                <x-table.cell>R$ {{$invoice->total_value}}</x-table.cell>
                                <x-table.cell>{{$invoice->processed === true ? 'Sim' : 'Não'}}</x-table.cell>
                            </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
        <div class="col-span-4 sm:col-span-2">
            <div class="bg-white dark:bg-gray-800 shadow-sm p-2 rounded-lg w-full h-16">
                <div class="flex items-center space-x-2">
                    <x-input-label for="discount">Desconto</x-input-label>
                    <x-text-input name="discount" id="discount" type="text"
                                  x-mask:dynamic="$money($input, '.')" placeholder="%" maxlength="4"
                                  class="block w-1/2 mt-1 " wire:model.defer="discount_percent"/>
                    <x-primary-button type="button" wire:click="calcDiscount">
                        <x-icon name="calculator" class="w-5 h-5"></x-icon>
                    </x-primary-button>
                </div>
            </div>
        </div>
        <div class="col-span-4 sm:col-span-4">
            <div class="inline-flex bg-white dark:bg-gray-800 shadow-sm p-2 rounded-lg w-full h-16">
                <div class="grid content-center mx-2">
                    <div class="inline-flex">
                        <span class="text-gray-500 dark:text-gray-200">Quantidade:</span>
                        <span class="text-gray-700 dark:text-gray-50 font-semibold">{{count($invoices)}}</span>
                    </div>
                </div>
                <div class="grid content-center mx-2">
                    <div class="inline-flex">
                        <span class="text-gray-500 dark:text-gray-200">Valor Bruto:</span>
                        <span
                            class="text-gray-700 dark:text-gray-50 font-semibold">R$ {{number_format((float)$discount_value, 2, '.', '')}}</span>
                    </div>
                </div>
                <div class="grid content-center mx-2">
                    <div class="inline-flex">
                        <span class="text-gray-500 dark:text-gray-200">Valor a Descontar:</span>
                        <span
                            class="text-gray-700 dark:text-gray-50 font-semibold">R$ {{number_format((float)$liquid_discount_value, 2, '.', '')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
        <div class="col-span-4 sm:col-span-2">
            <div class="bg-white dark:bg-gray-800 shadow-sm p-2 rounded-lg w-full h-16">
                <div class="flex items-center space-x-2">
                    <x-input-label for="payment">Pagamento</x-input-label>
                    <x-text-input name="payment" id="payment" type="text"
                                  x-mask:dynamic="$money($input, '.')" placeholder="%" maxlength="4"
                                  class="block w-1/2 mt-1 " wire:model.defer="payment_percent"/>
                    <x-primary-button type="button" wire:click="calcPayment">
                        <x-icon name="calculator" class="w-5 h-5"></x-icon>
                    </x-primary-button>
                </div>
            </div>
        </div>
        <div class="col-span-4 sm:col-span-4">
            <div class="inline-flex bg-white dark:bg-gray-800 shadow-sm p-2 rounded-lg w-full h-16">
                <div class="grid content-center mx-2">
                    <div class="inline-flex">
                        <span class="text-gray-500 dark:text-gray-200">Quantidade:</span>
                        <span
                            class="text-gray-700 dark:text-gray-50 font-semibold">{{count($invoices->where('payment_enable', true))}}</span>
                    </div>
                </div>
                <div class="grid content-center mx-2">
                    <div class="inline-flex">
                        <span class="text-gray-500 dark:text-gray-200">Valor Bruto:</span>
                        <span
                            class="text-gray-700 dark:text-gray-50 font-semibold">R$ {{number_format((float)$payment_value, 2, '.', '')}}</span>
                    </div>
                </div>
                <div class="grid content-center mx-2">
                    <div class="inline-flex">
                        <span class="text-gray-500 dark:text-gray-200">Valor a Pagar:</span>
                        <span
                            class="text-gray-700 dark:text-gray-50 font-semibold">R$ {{number_format((float)$liquid_payment_value, 2, '.', '')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div x-data="{open: false}" class="fixed bottom-4 right-4">
        <div x-show="open" class="grid space-y-2">
            <button wire:click="exportInvoicesPDF"
                    class="block w-10 h-10 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-2 rounded-full shadow-lg hover:scale-115 transition transform duration-75">
                <x-icon name="document" class="max-h-10 max-w-10 text-white"></x-icon>
            </button>
            <button wire:click="exportInvoices"
                    class="block w-10 h-10 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-2 rounded-full shadow-lg hover:scale-115 transition transform duration-75">
                <x-icon name="table" class="max-h-10 max-w-10 text-white"></x-icon>
            </button>
        </div>
        <button
            x-on:click="open = ! open"
            class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-2 rounded-full shadow-lg hover:scale-115 transition transform duration-75">
            <x-icon name="download" class="h-6 w-6 text-white"></x-icon>
        </button>
        <!--
                <button
                    wire:click="select"
                    class="bg-blue-600 hover:bg-blue-600 text-white font-bold py-4 px-4 rounded-full shadow-lg hover:rotate-90 transition transform duration-75">
                    <x-icon name="refresh" class="h-8 w-8 text-white"></x-icon>
                </button>
        -->
    </div>
    @livewire('administrativo::financial.edit-invoice')
</div>
