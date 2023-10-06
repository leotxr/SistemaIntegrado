<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}

                    @php
                    $arp=`arp -a`;
                    $lines=explode("\n", $arp);
                    $devices = array();
                    foreach($lines as $line){
                    $cols=preg_split('/\s+/', trim($line));
                    if(isset($cols[2]) && $cols[2]=='dynamic'){
                    $temp = array();
                    $temp['ip'] = $cols[0];
                    $temp['mac'] = $cols[1];
                    $devices[] = $temp;
                    }
                    }

                    print_r($arp);
                    @endphp

                    <x-table>
                        <x-slot name="head">
                            <x-table.heading>IP</x-table.heading>
                            <x-table.heading>MAC</x-table.heading>
                        </x-slot>
                        <x-slot name="body">
                            @foreach($devices as $device)
                            <x-table.row>
                                <x-table.cell>{{$device['ip']}}</x-table.cell>
                                <x-table.cell>{{$device['mac']}}</x-table.cell>
                            </x-table.row>
                            @endforeach
                        </x-slot>
                    </x-table>

                

                </div>
            </div>
        </div>
    </div>
</x-app-layout>