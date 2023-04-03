<!-- MODAL -->

<!-- Put this part before </body> tag -->
<input type="checkbox" id="my-modal-6" class="modal-toggle" />
<div class="modal">
  <div class="modal-box w-11/12 max-w-5xl">
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
