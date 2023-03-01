<head>
    @livewireStyles
</head>

<body>
    @livewireScripts
    <livewire:autorizacao::layouts.app />
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastro de Autorização') }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Pedido</h3>
                            <p class="mt-1 text-sm text-gray-600">Insira as informações do pedido para autorização.
                                Caso seja uma autorização sem agendamento, apenas clicar no botão <b>Consultar Protocolo</b>.
                            </p>
                        </div>
                    </div>
                    <div class="form_busca mt-5 md:col-span-2 md:mt-0">

                        <div class="shadow sm:overflow-hidden sm:rounded-md ">
                            <div class="space-y-6 bg-white px-4 py-5 sm:p-6 content-center">
                                <div class="gap-4 content-center">
                                    <label for="protocolo"
                                        class="block text-sm font-medium text-gray-700">Protocolo</label>
                                    <div class="mt-1">
                                        <input type="text" id="protocolo" name="protocolo"
                                            class="input input-success w-full max-w-xs" />
                                    </div>
                                    <button type="button" class="btn mt-2 btn-primary" id="get_protocol">Consultar
                                        Protocolo</button>
                                </div>

                                <div id="showprotocol">
                                </div>


                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $("#get_protocol").click(function() {
            const url = "{{ route('getProtocol') }}";
            protocolo = $("#protocolo").val();
            $.ajax({
                url: url,
                data: {
                    'protocolo': protocolo,
                },
                success: function(data) {
                    $("#showprotocol").html(data);
                }
            });
        });
    });
</script>
