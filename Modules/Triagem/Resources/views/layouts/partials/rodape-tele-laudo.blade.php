<div id="assinatura-telelaudo" class="grid grid-cols-3 sm:grid-cols-4 p-5 bg-white">
    <div>


        <!-- CLONE DA ASSINATURA -->
        <div id="parent2" class="parent text-center">
            <img src="" id="imgclone2" name="assinatura" class="child">
            <input type="text" value="" id="dataurltele" class="input bordered" name="dataurltele" hidden
                required />
            <div>
                Assinatura do Titular/Responsável
            </div>
        </div>
        <!-- FIM CLONE ASSINATURA -->

    </div>

    <div>
        <!-- The button to open modal -->
        <label for="my-modal-7" id="openmodal2" class="btn btn-outline btn-primary rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
        </label>


    </div>

    <div>
        <label class="font-bold" for="nome">
            Data do exame:
        </label>
        <input type="text" name="exam_date" id="exam_date" class="input w-full max-w-md text-md hidden"
            readonly />{{ date('d/m/Y', strtotime($paciente->DATA)) }}

        <input type="text" name="exam_date" id="exam_date" class="input w-full max-w-md text-md hidden" readonly
            value=" {{ $paciente->DATA }} " />
    </div>



</div>

