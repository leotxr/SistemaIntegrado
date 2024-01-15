<div>
    <div wire:loading>
        @livewire('gestao::utils.loading-screen')
    </div>
    <form wire:submit.prevent="render">
        <div class="grid grid-cols-2 sm:grid-cols-8 gap-2 ">
            <div class="col-span-2 sm:col-span-2 mt-4">
                <x-input-label for="start_date">Data Inicial</x-input-label>
                <x-text-input id="start_date" wire:model.defer="start_date" type="date" class="w-full"></x-text-input>
            </div>
            <div class="col-span-2 sm:col-span-2 mt-4">
                <x-input-label for="end_date">Data Inicial</x-input-label>
                <x-text-input id="end_date" wire:model.defer="end_date" type="date" class="w-full"></x-text-input>
            </div>
            <div class="col-span-2 sm:col-span-2 mt-4 grid place-content-center">
                <x-primary-button type="submit" class="w-full">Buscar</x-primary-button>
            </div>
            <div class="col-span-2 sm:col-span-2 mt-4 grid place-content-center">
                <x-primary-button wire:click="exportXLS" class="w-full bg-green-800 hover:bg-green-600">Exportar</x-primary-button>
            </div>
        </div>
    </form>
    <div>
        <div class="text-center">
            <x-table>
                <x-slot:head>
                    <x-table.heading>
                        <span class="grid justify-items-center"><x-icon name="emoji-happy" class="w-8 h-8 text-green-600" solid></x-icon></span>
                    </x-table.heading>
                    <x-table.heading>
                        <span class="grid justify-items-center"><x-icon name="emoji-happy" class="w-8 h-8 text-yellow-400" solid></x-icon></span>
                    </x-table.heading>
                    <x-table.heading>
                        <span class="grid justify-items-center"><x-icon name="emoji-sad" class="w-8 h-8 text-red-600" solid></x-icon></span>
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
        <div>
            <x-table>
                <x-slot:head>
                    <x-table.heading>
                        Recepcionista
                    </x-table.heading>
                    <x-table.heading>
                        <span class="grid justify-items-center"><x-icon name="emoji-happy" class="w-8 h-8 text-green-600" solid></x-icon></span>
                    </x-table.heading>
                    <x-table.heading>
                        <span class="grid justify-items-center"><x-icon name="emoji-happy" class="w-8 h-8 text-yellow-400" solid></x-icon></span>
                    </x-table.heading>
                    <x-table.heading>
                        <span class="grid justify-items-center"><x-icon name="emoji-sad" class="w-8 h-8 text-red-600" solid></x-icon></span>
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
        <div>
            <div class="mt-4">
                <x-select wire:model="limit">
                    <x-slot:option>
                        @foreach($limits as $total_limit)
                            <x-select.option value="{{$total_limit}}">{{$total_limit}} Resultados</x-select.option>
                        @endforeach
                    </x-slot:option>
                </x-select>
                <span class="text-gray-600 dark:text-gray-50 text-sm">Mostrando os {{$limit}} primeiros resultados de {{$total_count->count()}}.</span>
                <span class="text-gray-500 dark:text-gray-100 text-xs">Para otimizar desempenho não serão mostrados os {{$total_count->count()}} resultados. Para visualização completa, utilize a exportação.</span>
            </div>
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


</div>
