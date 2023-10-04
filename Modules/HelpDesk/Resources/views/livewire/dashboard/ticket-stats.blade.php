<div class="grid grid-cols-1 gap-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xs:grid-cols-1">
    <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800 ">
        <x-title>Tempo médio de atendimento</x-title>
        <span class="text-xs font-light text-gray-500">Tempo médio entre o início e final do atendimento</span>
        <div class="grid content-center h-48 text-center">
            <x-title class="text-5xl font-extrabold oldstyle-nums">@if(empty($tma_hoje)) 00:00:00 @else{{gmdate("H:i:s", $tma_hoje)}} @endif</x-title>
            <span class="text-gray-400">Hoje</span>
            <div class="border-t">
                <div class="grid grid-cols-2 gap-2 border-r">
                    <div>
                        <x-title class="text-3xl font-bold oldstyle-nums">@if(empty($tma_ontem)) 00:00:00 @else{{gmdate("H:i:s", $tma_ontem)}} @endif</x-title>
                        <span class="text-gray-400">Ontem</span>
                    </div>
                    <div>
                        <x-title class="text-3xl font-bold oldstyle-nums">@if(empty($tma_7d)) 00:00:00 @else{{gmdate("H:i:s", $tma_7d)}} @endif</x-title>
                        <span class="text-gray-400">7 dias</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800 ">
        <x-title>Tempo médio de espera</x-title>
        <span class="text-xs font-light text-gray-500">Tempo médio de espera até o início do atendimento</span>
        <div class="grid content-center h-48 text-center">
            <x-title class="text-5xl font-extrabold oldstyle-nums">@if(empty($tme_hoje)) 00:00:00 @else{{gmdate("H:i:s", $tme_hoje)}} @endif</x-title>
            <span class="text-gray-400">Hoje</span>
            <div class="border-t">
                <div class="grid grid-cols-2 gap-2 border-r">
                    <div>
                        <x-title class="text-3xl font-bold oldstyle-nums">@if(empty($tme_ontem)) 00:00:00 @else{{gmdate("H:i:s", $tme_ontem)}} @endif </x-title>
                        <span class="text-gray-400">Ontem</span>
                    </div>
                    <div>
                        <x-title class="text-3xl font-bold oldstyle-nums">@if(empty($tme_7d)) 00:00:00 @else{{gmdate("H:i:s", $tme_7d)}} @endif </x-title>
                        <span class="text-gray-400">7 dias</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>