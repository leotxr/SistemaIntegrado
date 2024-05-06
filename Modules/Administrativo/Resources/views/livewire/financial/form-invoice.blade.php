<div class="space-y-2">
    <div>
        @livewire('administrativo::financial.search-invoice')
    </div>
    <div class="shadow sm:overflow-hidden sm:rounded-md ">
        @isset($invoice)
            <div class="content-center px-4 py-5 space-y-6 bg-white dark:bg-gray-800 sm:p-6">
                <div>
                    <x-title>Informações do exame {{$invoice_id}}</x-title>
                    <form wire:submit.prevent="saveInvoice" enctype="multipart/form-data">
                        @csrf
                        <div
                            class="grid grid-cols-2 sm:grid-cols-4 gap-2 p-2 mt-4 border dark:border-gray-700 rounded-lg shadow-sm">

                            <div class="mt-4 col-span-2 sm:col-span-2">
                                <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Código Paciente
                                </dt>
                                <dd class="dark:bg-gray-900 dark:text-gray-300">{{$invoice->patient_id}}</dd>
                            </div>

                            <div class="mt-4 col-span-2 sm:col-span-2">
                                <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Paciente
                                </dt>
                                <dd class="dark:bg-gray-900 dark:text-gray-300">{{$invoice->patient_name}}</dd>
                            </div>

                            <div class="mt-4 col-span-2 sm:col-span-2">
                                <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Procedimento
                                </dt>
                                <dd class="dark:bg-gray-900 dark:text-gray-300">{{$invoice->exam_description}}</dd>
                            </div>

                            <div class="mt-4 col-span-2 sm:col-span-2">
                                <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Data
                                </dt>
                                <dd class="dark:bg-gray-900 dark:text-gray-300">{{date('d/m/Y', strtotime($invoice->exam_date))}}</dd>
                            </div>

                            <div class="mt-4 col-span-2 sm:col-span-2">
                                <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Convênio
                                </dt>
                                <dd class="dark:bg-gray-900 dark:text-gray-300">{{$invoice->insurance}}</dd>
                            </div>

                            <div class="mt-4 col-span-2 sm:col-span-2">
                                <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Médico
                                </dt>
                                <dd class="dark:bg-gray-900 dark:text-gray-300">{{$invoice->doctor}}</dd>
                            </div>

                            <div class="mt-4 col-span-2 sm:col-span-2">
                                <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Valor Pago Convênio
                                </dt>
                                <dd class="dark:bg-gray-900 dark:text-gray-300">{{number_format($invoice->paid_insurance, 2, ',', '')}}</dd>
                            </div>

                            <div class="mt-4 col-span-2 sm:col-span-2">
                                <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Valor Pago Paciente
                                </dt>
                                <dd class="dark:bg-gray-900 dark:text-gray-300">{{number_format($invoice->paid_patient, 2, ',', '')}}</dd>
                            </div>
                            <div class="mt-4 col-span-2 sm:col-span-2">
                                <dt class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                                    Valor Total
                                </dt>
                                <dd class="dark:bg-gray-900 dark:text-gray-300">{{number_format($invoice->total_value, 2, ',', '')}}</dd>
                            </div>
                            <div class="mt-4 col-span-2 sm:col-span-2 inline-flex">
                                <x-text-input type="checkbox" class="mx-2 checkbox" id="checkbox" name="checkbox"
                                              wire:model="invoice.payment_enable"/>
                                <x-input-label for="checkbox" :value="__('Pagamento (Médico assinante vai revisar)')"/>
                            </div>
                            @json($invoice->payment_enable)
                        </div>

                        <div class="px-4 py-3 text-right sm:px-6">
                            <x-primary-button type="submit" class="mt-2">Enviar</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        @endisset
    </div>
</div>
