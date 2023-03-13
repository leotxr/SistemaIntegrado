<div class="w-lg bg-white rounded-md grid grid-cols-2 sm:grid-cols-3">
    <div>
        <label class="label font-bold" for="nome">
            Nome:
        </label>
        <input type="text" name="nome" id="nome" class="input w-full max-w-md text-md" readonly
            value=" {{ $termo->patient_name }} " />
    </div>
    <div>
        <label class="label font-bold" for="nome">
            Data de Nascimento:
        </label>
        <input type="text" name="patient_age" id="" class="input w-full max-w-md text-md hidden"
            readonly />{{ date('d/m/Y', strtotime($termo->patient_age)) }}

    </div>

    <div>
        <label class="label font-bold" for="medico">
            Médico
        </label>
        <select id="medico" name="medico" class="select select-bordered w-full max-w-xs">
            <option disabled selected>Médico</option>
            @foreach($medico as $medicos)
            <option value="{{$medicos->id}}">{{$medicos->name}}</option>
            @endforeach
        </select>
    </div>




</div>
<script>
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
                $("#rodape-contraste-rm").html(data)
            }
        });
    });
</script>