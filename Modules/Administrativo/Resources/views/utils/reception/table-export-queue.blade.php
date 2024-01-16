<div>
    <div class="text-center">
        <x-table>
            <x-slot:head>
                <x-table.heading>
                    Verde
                </x-table.heading>
                <x-table.heading>
                    Amarelo
                </x-table.heading>
                <x-table.heading>
                    Vermelho
                </x-table.heading>
            </x-slot:head>
            <x-slot:body>
                <x-table.row>
                    <x-table.cell
                        class="text-2xl text-center">{{$total_count->where('ATRASO_ATEND', '<', 600)->count()}}</x-table.cell>
                    <x-table.cell
                        class="text-2xl text-center">{{$total_count->where('ATRASO_ATEND', '>=', 600)->where('ATRASO_ATEND', '<', 900)->count()}}</x-table.cell>
                    <x-table.cell
                        class="text-2xl text-center">{{$total_count->where('ATRASO_ATEND', '>=', 900)->count()}}</x-table.cell>
                </x-table.row>
            </x-slot:body>
        </x-table>
    </div>
    {{--
    <div>
        <x-table>
            <x-slot:head>
                <x-table.heading>
                    Recepcionista
                </x-table.heading>
                <x-table.heading>
                    Verde
                </x-table.heading>
                <x-table.heading>
                    Amarelo
                </x-table.heading>
                <x-table.heading>
                    Vermelho
                </x-table.heading>
            </x-slot:head>
            <x-slot:body>
                @foreach($users as $user)
                    @if($total_count->where('USERID', $user->USUARIO_ID)->count() > 0)
                        <x-table.row>
                            <x-table.cell class="text-center">{{$user->USUARIO_NOME}}</x-table.cell>
                            <x-table.cell
                                class="text-center">{{$total_count->where('ATRASO_ATEND', '<', 600)->where('USERID', $user->USUARIO_ID)->count()}}</x-table.cell>
                            <x-table.cell
                                class="text-center">{{$total_count->where('ATRASO_ATEND', '>=', 600)->where('ATRASO_ATEND', '<', 900)->where('USERID', $user->USUARIO_ID)->count()}}</x-table.cell>
                            <x-table.cell
                                class="text-center">{{$total_count->where('ATRASO_ATEND', '>=', 900)->where('USERID', $user->USUARIO_ID)->count()}}</x-table.cell>
                        </x-table.row>
                    @endif
                @endforeach
            </x-slot:body>
        </x-table>
    </div>
    --}}
    <div>
        <x-table>
            <x-slot:head>
                <x-table.heading>Data</x-table.heading>
                <x-table.heading>Senha</x-table.heading>
                <x-table.heading>Chegada</x-table.heading>
                <x-table.heading>Atendido</x-table.heading>
                <x-table.heading>Atraso</x-table.heading>
                <x-table.heading>Atendente</x-table.heading>
            </x-slot:head>
            <x-slot:body>
                @forelse($query as $q)
                    <x-table.row>
                        <x-table.cell class="text-center">{{date('d/m/Y', strtotime($q->DATA))}}</x-table.cell>
                        <x-table.cell class="text-center">{{$q->SENHA}}</x-table.cell>
                        <x-table.cell class="text-center">
                            {{gmdate('H:i:s', $q->HORACHEGADA)}}
                        </x-table.cell>
                        <x-table.cell class="text-center">
                            {{gmdate('H:i:s', $q->HORAATEND)}}
                            {{-- now()->format('H:i:s') --}}
                        </x-table.cell>
                        <x-table.cell class="text-center">
                            {{gmdate('H:i:s', $q->ATRASO_ATEND)}}
                        </x-table.cell>
                        <x-table.cell class="text-center">
                            {{$q->USUARIO}}
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell>
                            Sem dados
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot:body>
        </x-table>
    </div>

</div>
