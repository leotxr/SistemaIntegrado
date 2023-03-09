<div class="grid grid-cols-2 sm:grid-cols-2 gap-5 text-center justify-items-center py-5">

    @foreach ($users as $user)
        
    @endforeach
    <div class="text-left">
        <img src="{{URL::asset($user->signature)}}" id="sig_medico" name="sig_medico">
        <label for="medico">{{$user->name}}</label>
    </div>


    <div class="text-left">
        <img src="{{ URL::asset(auth()->user()->signature) }}" id="medico" name="medico">
        <label for="medico">{{auth()->user()->name}}</label>
    </div>

</div>