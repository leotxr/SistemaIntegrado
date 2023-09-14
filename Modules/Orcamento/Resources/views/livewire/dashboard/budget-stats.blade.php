<div class="grid w-full grid-cols-2 gap-1 px-2 py-4 bg-white divide-x-2 divide-x-reverse dark:bg-gray-800 sm:grid-cols-8 divide-solid"
    x-data="{
        stats: [
            {id: 1, label: 'Orçamentos', value: {{$count_budgets->count()}}},
            {id: 2, label: 'Agendados', value: {{$count_budgets->where('budget_status_id', 3)->count()}}},
            {id: 3, label: 'Não Agendados', value: {{$count_budgets->where('budget_status_id', 2)->count()}}},
            {id: 4, label: 'Pendentes', value: {{$count_budgets->where('budget_status_id', 1)->count()}}}
        ]
    }">

    <template x-for="stat in stats" :key="stat.id">
        <div class="col-span-1 text-center sm:col-span-2">
            <div>
                <span class="text-3xl font-bold text-gray-700 dark:text-gray-50" x-text="stat.value"></span>
            </div>
            <div>
                <span class="text-sm text-gray-500 font-regular dark:text-gray-200" x-text="stat.label"></span>
            </div>
        </div>
    </template>
</div>