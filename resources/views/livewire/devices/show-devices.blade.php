<div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
    <div class="p-4 text-gray-900 dark:text-gray-100">
        <div class="overflow-x-auto">

            <x-table>
                <!-- head -->
                <x-slot name="head">
                    <x-table.heading>Nome</x-table.heading>
                    <x-table.heading>IP</x-table.heading>
                    <x-table.heading>Ultima Resposta</x-table.heading>
                    <x-table.heading>Estado</x-table.heading>
                    <x-table.heading>Ação</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @php
                    $output = NULL;
                    $result = NULL;
                    @endphp
                    @foreach ($devices as $device)
                    @php


                    @endphp
                    <x-table.row>
                        <x-table.cell>{{ $device->name}}</x-table.cell>
                        <x-table.cell>{{ $device->ip_address }}</x-table.cell>
                        <x-table.cell>{{ $device->last_response }}</x-table.cell>
                        <x-table.cell class="flex">
                            {{$device->active}}
                        </x-table.cell>
                        <x-table.cell>@if($device->link)<a href="{{$device->link}}" type="button"
                                target="_blank"><x-icon name="external-link" class="w-6 h-6 hover:dark:text-gray-50 hover:text-gray-900" /></a>@endif</x-table.cell>
                    </x-table.row>

                    @endforeach
                </x-slot>

            </x-table>

        </div>
    </div>
</div>