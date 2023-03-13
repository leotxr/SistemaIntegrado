<div class="grid grid-cols-2 sm:grid-cols-2 gap-5 text-center justify-items-center">

    <div class="text-left inset-x-0 bottom-0">
        @foreach($user as $medico)
        <img src="{{ URL::asset($medico->signature) }}" class="max-w-20 max-h-12" id="sig_medico"  name="sig_medico">
        @endforeach
        <label for="medico">Médico</label>
    </div>


    <div class="text-left inset-x-0 bottom-0">
        <img src="{{ URL::asset(auth()->user()->signature) }}" id="enfermagem" name="enfermagem">
        <label for="enfermagem">Enfermagem</label>
    </div>


</div>

