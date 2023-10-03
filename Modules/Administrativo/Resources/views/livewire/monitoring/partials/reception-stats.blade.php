<div>
    <div
        class="grid w-full grid-cols-2 gap-1 px-2 py-4 bg-white divide-x-2 shadow-sm dark:bg-gray-800 sm:grid-cols-10 divide-solid">
        <div class="content-center col-span-2 row-span-2 p-4 text-center sm:col-span-2">
            <div>
                <span class="font-bold text-gray-700 text-7xl dark:text-gray-50">{{$queue->count()}}</span>
            </div>
            <div>
                <span class="text-xl text-gray-500 font-regular dark:text-gray-200">Total</span>
            </div>
        </div>



        <div class="grid col-span-2 grid-rows-2 gap-1 text-center divide-y-2 sm:col-span-4 divide-solid">
            <div class="row-span-1">
                <div>
                    <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$waiting->count()}}</span>
                </div>
                <div>
                    <span class="text-gray-500 text-md font-regular dark:text-gray-200">Aguardando</span>
                </div>
            </div>
            <div class="grid grid-cols-2 row-span-1 divide-x-2 divide-solid">
                <div>
                    <div>
                        <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$waiting->whereIn('TIPOFILA', ['A', 'P'])->count()}}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 text-md font-regular dark:text-gray-200">Atendimento</span>
                    </div>
                </div>
                <div>
                    <div>
                        <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$waiting->where('TIPOFILA', 'T')->count()}}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 text-md font-regular dark:text-gray-200">Marcação</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid col-span-2 grid-rows-2 gap-1 text-center divide-y-2 sm:col-span-4 divide-solid">
            <div class="row-span-1">
                <div>
                    <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$served->count()}}</span>
                </div>
                <div>
                    <span class="text-gray-500 text-md font-regular dark:text-gray-200">Atendidos</span>
                </div>
            </div>
            <div class="grid grid-cols-2 row-span-1 divide-x-2 divide-solid">
                <div>
                    <div>
                        <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$served->whereIn('TIPOFILA', ['A', 'P'])->count()}}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 text-md font-regular dark:text-gray-200">Atendimento</span>
                    </div>
                </div>
                <div>
                    <div>
                        <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$served->where('TIPOFILA', 'T')->count()}}</span>
                    </div>
                    <div>
                        <span class="text-gray-500 text-md font-regular dark:text-gray-200">Marcação</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>