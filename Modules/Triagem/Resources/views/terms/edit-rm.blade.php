@extends('triagem::layouts.master')

@section('content')
    <div>
        <form method="POST" action="{{url("triagem/terms/$termo->id")}}">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-12 p-5">
                        @include('triagem::layouts.partials.contraste.cabecalho-contraste-rm')
                    </div>
                    <div id="odio">
                        <div class="col-12 p-5">
                            <livewire:triagem::components.termo-rm />
                        </div>
                        <div class="col-12 p-5" id="questionario">
                            <livewire:triagem::components.contraste.quest-contraste />
                        </div>
                        <div class="col-12 p-5" id="rodape-contraste-rm">
                            {{-- @include('triagem::layouts.partials.contraste.rodape-contraste-rm') --}}
                        </div>

                        <div class="col-12 p-5" id="rodape-observacao-rm">
                            @include('triagem::layouts.partials.observacao')
                        </div>
                        
                    </div>
                </div>
                <input type="text" value="" id="dataurlcontraste" name="dataurlcontraste" hidden
                    class="input input-bordered" />
            </div>


            <div class="grid justify-items-end p-12">
                <label for="my-modal-6" id="print" class="btn brn-primary">Salvar</label>
                {{-- <button wire:click="submit" type="submit" class="btn btn-primary rounded-sm">Enviar</button> --}}
            </div>

    </div>

    {{-- MODAL --}}
    <input type="checkbox" id="my-modal-6" class="modal-toggle" />
    <div class="modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Salvar Formulário?</h3>
            <p class="py-4">Certifique-se de que as informações inseridas no formulário estejam corretas. <b>Não será
                    possível editar após salvo!</b>
            </p>
            <div class="modal-action">
                <label for="my-modal-6" id="fechar-modal-6" class="btn btn-error">Cancelar</label>
                <button type="submit" for="my-modal-6" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </div>
    
    </form>
    <script>
        $(document).ready(function() {

            $("#print").click(function() {

                $("body").toggleClass("overflow-hidden");

                //tira print da div
                html2canvas(document.querySelector('#odio')).then(canvas => {
                    //document.body.appendChild(canvas);
                    var dataUrlContraste = canvas.toDataURL();
                    $("#dataurlcontraste").val(dataUrlContraste);
                });

            });

            $("#fechar-modal-6").click(function() {
                $("body").toggleClass("overflow-hidden");
            });

        });
    </script>
@endsection
