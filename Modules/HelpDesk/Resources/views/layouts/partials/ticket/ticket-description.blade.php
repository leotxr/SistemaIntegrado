<div>
    <div class="border p-2">
        <div>
            @isset($chamado->atendente_id)
            <x-helpdesk::ticket-avatar name="{{$atendente->name}}" role="Atendente"
                img="{{URL::asset($atendente->profile_img)}}"></x-helpdesk::ticket-avatar>
            @endisset
            @empty($chamado->atendente_id)

            @php $novo_status = 4; @endphp
            <form method="GET" action="{{ route('ticket.status_update', ['id'=>$chamado->id,
            'novo_status'=>$novo_status]) }}">
                @csrf
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-2 content-center">
                    <div class="max-w-sm p-2">
                        <label for="atendente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vincular
                            novo Atendente</label>
                        <select id="atendente" name="atendente_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="{{auth()->user()->id}}">{{auth()->user()->name}}</option>
                            @foreach($user_ti as $users_ti)
                            <option value="{{$users_ti->id}}">{{$users_ti->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="m-9">
                        <button type="submit" id="atender"
                            class="focus:outline-none text-white bg-indigo-400 hover:bg-indigo-600 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                            Vincular</button>
            </form>
        </div>
    </div>
    @endempty
    <div class="text-gray-800 font-medium p-2">
        {{$chamado->descricao_fechamento}}
    </div>
</div>
</div>
<div class="border p-2">
    <div>
        @include('helpdesk::layouts.partials.components.message-avatar')
        <div class="text-gray-800 font-medium p-2">
            {{$chamado->descricao_abertura}}
        </div>
    </div>
</div>
</div>