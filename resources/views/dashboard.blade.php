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
                    {{now()}}

                    <div>
                        @php
                        $output = null;
                        $result = null;
                        $printers = ["192.168.254.244", "192.168.254.245", "192.168.254.243", "192.168.254.22",
                        "192.168.254.21", "192.168.254.162"];
                        @endphp
                        @foreach($printers as $printer)
                        @php
                        exec("ping -n 1 -w 1 " . $printer, $output, $result);
                        @endphp
                        <div class="grid grid-cols-4 gap-2">
                            <div class="col-span-2">
                                {{$printer}}
                            </div>
                            <div class="col-span-1">
                                {{$result == 0 ? 'Online' : 'Offline'}}
                            </div>
                        </div>
                        
                        @endforeach
                        @php
                        exec("explorer", $output, $result);
                        @endphp
                        



                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>