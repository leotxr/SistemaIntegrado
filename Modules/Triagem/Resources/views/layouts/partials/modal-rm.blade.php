<!-- MODAL -->

<!-- Put this part before </body> tag -->
<input type="checkbox" id="my-modal-6" class="modal-toggle" />
<div class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <livewire:triagem::components.assinaturas-rm />

    </div>
</div>
<!-- FIM MODAL -->

<script>
    $(document).ready(function() {
        $("#openmodal").click(function() {
            $("body").toggleClass("overflow-hidden");
        });
    });
</script>
