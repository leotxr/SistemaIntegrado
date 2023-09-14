<div>
    <div class="grid w-full grid-cols-2 gap-1 px-2 py-4 bg-white divide-x-2 dark:bg-gray-800 sm:grid-cols-6 divide-solid">
        <div class="col-span-1 text-center sm:col-span-1">
            <div>
                <span class="text-3xl font-bold text-gray-700 dark:text-gray-50">{{$count_budgets->count()}}</span>
            </div>
            <div>
                <span class="text-sm text-gray-500 font-regular dark:text-gray-200">Orçamentos</span>
            </div>
        </div>
        <div class="col-span-1 text-center sm:col-span-1">
            <div>
                <span class="text-3xl font-bold text-gray-700 dark:text-gray-50">{{$count_budgets->where('budget_status_id', 3)->count()}}</span>
            </div>
            <div>
                <span class="text-sm text-gray-500 font-regular dark:text-gray-200">Agendados</span>
            </div>
        </div>
        <div class="col-span-2 text-center sm:col-span-1">
            <div>
                <span class="text-3xl font-bold text-gray-700 dark:text-gray-50">{{$count_budgets->where('budget_status_id', 2)->count()}}</span>
            </div>
            <div>
                <span class="text-sm text-gray-500 font-regular dark:text-gray-200">Não Agendados</span>
            </div>
        </div>
        <div class="col-span-1 text-center sm:col-span-1">
            <div>
                <span class="text-3xl font-bold text-gray-700 dark:text-gray-50">{{$count_budgets->where('budget_status_id', 1)->count()}}</span>
            </div>
            <div>
                <span class="text-sm text-gray-500 font-regular dark:text-gray-200">Pendentes</span>
            </div>
        </div>
        <div class="flex col-span-1 space-x-2 text-center sm:col-span-2">
            <div>
                
            </div>
            <div>
                
            </div>
        </div>
    </div>
</div>