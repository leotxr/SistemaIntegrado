<div class="m-2 border border-dashed rounded-lg dark:bg-gray-900">
    <h2 class="p-2 text-xl font-extrabold dark:text-white">{{ $title }}</h2>
    <div class="content-center w-full max-w-screen-xl p-4 mx-auto md:py-8">
        <div class="grid grid-cols-2 gap-4 text-center">
            <div>
                <div class="justify-center">
                    <img src="{{ URL::asset($signature_path) }}" value="{{ URL::asset($signature_path) }}" class="h-16" id="assinatura_medico" name="assinatura_medico">
                    <hr class="border-gray-200 sm:mx-auto dark:border-gray-700" />
                </div>
                <p id="nome_medico" class="mt-2 text-sm text-green-600 dark:text-green-400">Dr(a). {{ $name }}
                    {{ $lastname }}</p>
            </div>

            <div>
                <div class="justify-center">
                    <img src="{{ URL::asset(auth()->user()->signature) }}"  class="h-16" id="assinatura_enfermagem"
                    value="{{ URL::asset(auth()->user()->signature) }}"    
                    name="assinatura_enfermagem">
                    <hr class="border-gray-200 sm:mx-auto dark:border-gray-700" />
                </div>
                <p id="nome_enfermagem" class="mt-2 text-sm text-green-600 dark:text-green-400">
                    {{ auth()->user()->name }}
                    {{ auth()->user()->lastname }}</p>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
            {{-- SELECT MEDICO --}}
            <div>
                <label class="font-bold label" for="medico">
                    Médico
                </label>
                <select wire:model="medico" class="w-full max-w-xs select select-bordered" name="medico">
                    <option selected>Selecione o médico</option>
                    @foreach ($user_medico as $medico)
                        <option value="{{ $medico->id }}">{{ $medico->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="bg-blue-600 rounded-full btn hover:bg-blue-700" wire:click='showSignature'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="white" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                </button>
            </div>

            {{-- INPUTS COM DATAURL DA ASSINATURA E PRINT DA TELA --}}
            <div class="flex items-center mr-4">
                <input type="text" value="" class="input input-xs" id="dataurl" class="" name="dataurl" required />
            </div>
        </div>
    </div>
</div>
