<div class="rounded-lg border border-dashed dark:bg-gray-900 m-2">
    <h2 class="text-xl font-extrabold dark:text-white p-2">{{ $title }}</h2>
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
       
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        {{--OBSERVACOES --}}
        <div class="col-span-full">
            @livewire('triagem::text-area', ['label' => "Observação", 'description' => "Observações da triagem"])
        </div>
        <div class="flex">
            {{-- INPUTS COM DATAURL DA ASSINATURA E PRINT DA TELA --}}
            <div class="flex items-center mr-4">
                <input type="text" value="" id="dataurl" class="" name="dataurl" required />
                <label for="dataurl" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tela</label>
            </div>

            <div class="flex items-center ml-4 max-w-sm">
                <input type="text" value="" id="dataurlsign" class="w-full" name="dataurlsign" />
                <label for="dataurl" class="w-full">Ass</label>
            </div>
        </div>
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">{{ $description }}</span>
    </div>
</div>
