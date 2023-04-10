<div class="rounded-lg border border-dashed dark:bg-gray-900 m-2">
    <h2 class="text-xl font-extrabold dark:text-white p-2">{{ $title }}</h2>
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8 content-center">
        <div class="grid grid-cols-2 gap-4 text-center">
            <div>
                <div class="justify-center">
                    <img src="" id="assinatura_medico" name="assinatura_medico">
                    <hr class="border-gray-200 sm:mx-auto dark:border-gray-700" />
                </div>
                <p id="nome_medico" class="mt-2 text-sm text-green-600 dark:text-green-400">Nome do médico aqui</p>
            </div>

            <div>
                <div class="justify-center">
                    <img src="{{ URL::asset(auth()->user()->signature) }}" id="assinatura_enfermagem"
                        name="assinatura_enfermagem">
                    <hr class="border-gray-200 sm:mx-auto dark:border-gray-700" />
                </div>
                <p id="nome_enfermagem" class="mt-2 text-sm text-green-600 dark:text-green-400">{{ auth()->user()->name }}
                    {{ auth()->user()->lastname }}</p>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="flex">
            {{-- INPUTS COM DATAURL DA ASSINATURA E PRINT DA TELA --}}
            <div class="flex items-center mr-4">
                <input type="text" value="" id="dataurl" class="" name="dataurl" required />
                <label for="dataurl" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tela</label>
            </div>

            <div class="flex items-center mr-4">
                <label class="label font-bold" for="medico">
                    Médico
                </label>
                <select id="medico" name="medico" class="select select-bordered w-full max-w-xs">
                    <option disabled selected>Médico</option>
                    @foreach ($medico as $medicos)
                        <option value="{{ $medicos->id }}">{{ $medicos->name }}</option>
                    @endforeach
                </select>
                <div id="teste">

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#medico").change(function() {
        
        let userID = $("#medico").val();
        var showSignature = "{{ route('show_signature', ['id' => ]) }}";
        $.ajax({
            url: "",
            success: function(data) {
                //$("#teste").html(data)
                alert(data)
            }
        });
    });
</script>