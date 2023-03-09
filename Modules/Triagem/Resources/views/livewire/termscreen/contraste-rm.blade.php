<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:triagem::layouts.app />
    <div id="capture" class="bg-white">
        <div name="header" class="text-center p-5">
            <h2 class="font-semibold text-2xl leading-tight">
                {{ __('Formulário de uso do contraste') }}
            </h2>
        </div>
        <form method="post" action="/triagem/terms/{{ $term->id }}">
            @method('PUT')
            @csrf

            <div>
                <div class="w-lg bg-white rounded-md grid grid-cols-2 sm:grid-cols-3">
                    <div>
                        <label class="label font-bold" for="nome">
                            Nome:
                        </label>
                        <input type="text" name="nome" id="nome" class="input w-full max-w-md text-md"
                            readonly value=" {{ $term->patient_name }} " />
                    </div>

                    <div>
                        <label class="label font-bold" for="medico">
                            Médico:
                        </label>
                        <select class="select select-bordered w-full max-w-xs" id="medico" required>
                            <option disabled selected>Médico</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <livewire:triagem::components.rm-contrast />
            </div>

            <div>
                <input type="text" value="" id="dataurl3" class="input" name="dataurl" required />
            </div>

            <div class="justify-right">
                <label for="my-modal-3" id="print" class="btn btn-primary">Salvar</label>
            </div>




            <!-- MODAL -->
            <input type="checkbox" id="my-modal-3" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box relative">
                    <h3 class="font-bold text-lg">Inserir Constraste</h3>
                    <p class="py-4">Tem certeza que deseja inserir o contraste para esta triagem? Certifique que os
                        valores
                        estão
                        corretos, não será possível alterar!
                    </p>
                    <div class="modal-action">
                        <label for="my-modal-3" class="btn btn-error">Fechar</label>
                        <button type="submit" id="btn-salvar" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</body>

<script>
    $(document).ready(function() {


        $("#print").click(function() {
            //tira print da div
            html2canvas(document.querySelector("#capture")).then(canvas => {
                //document.body.appendChild(canvas);
                var dataUrl3 = canvas.toDataURL();
                $("#dataurl3").val(dataUrl3);
                //alert(dataUrl3);
            });

        });

        /*
        $("#medico").change(function() {
            const url = "{{ route('show_signature') }}";
            userID = $("#medico").val();
            $.ajax({
                url: url,
                data: {
                    'medico': userID,
                },
                success: function(data) {
                    //$("#sig_medico").attr("src", data);
                    $("#assinaturas").html(data)
                }
            });
        });
        */

    });
</script>
