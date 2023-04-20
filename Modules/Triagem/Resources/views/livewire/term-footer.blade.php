<div class="rounded-lg border border-dashed dark:bg-gray-900 m-2">
    <h2 class="text-xl font-extrabold dark:text-white p-2">{{ $title }}</h2>
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <button type="button" data-modal-target="staticModal" data-modal-toggle="staticModal"
                    class="flex items-center mb-4 sm:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"></span>
                </button>
                <div id="parent2" class="parent justify-left">
                    <div class="max-w-sm ">
                        <img src="{{ URL::asset($img) }}" id="imgclone" name="assinatura" class="">
                        {{-- <img src="" id="imgclone" name="assinatura" class="child"> --}}
                    </div>
                    <p class="my-4 text-md font-normal text-gray-500 dark:text-gray-400">Assinatura do titular ou
                        responsável</p>
                </div>
            </div>
            <div>
                <a class="flex items-center mb-4 sm:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"></span>
                </a>
                <div id="parent2" class="parent justify-left mx-10">
                    <p class="my-4 text-lg font-normal dark:text-gray-400"><input type="text" class="input bg-base"
                            hidden name="data_exame"
                            value="{{ $data_exame }}" />{{ date('d/m/Y', strtotime($data_exame)) }}</p>
                    <p class="my-4 text-md font-normal text-gray-500 dark:text-gray-400">Data do exame</p>
                </div>
            </div>
        </div>
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
