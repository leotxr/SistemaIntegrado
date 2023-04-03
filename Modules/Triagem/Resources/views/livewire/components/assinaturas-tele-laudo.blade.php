<div>
    <div id="parent" class="parent p-2 ">
        Não é necessário assinar novamente.
        <x-triagem::signature-pad hidden> </x-triagem::signature-pad>
    </div>
    <div class="modal-action">
        <a type="button" class="btn btn-warning" onclick="clearCanvas()">Limpar</a>
        <label for="my-modal-7" id="fechar" class="btn btn-error">Cancelar</label>
        <label for="my-modal-7" id="clone2" class="btn btn-primary">Enviar</label>
    </div>

</div>
<script>
    



    $("#clone2").click(function() {
        var dataUrl = canvas.toDataURL();
        $("#imgclone2").attr("src", dataUrl);

        $("body").toggleClass("overflow-hidden");

        //tira print da div
        html2canvas(document.querySelector("#termo-tele-laudo")).then(canvas => {
            //document.body.appendChild(canvas);
            var dataUrl2 = canvas.toDataURL();
            $("#dataurltele").val(dataUrl2);
        });
    });

    $("#fechar").click(function() {
        $("body").toggleClass("overflow-hidden");
    })
</script>
