<div>
    <div class="grid grid-cols-1 gap-3 text-center justify-items-center sm:grid-cols-8" x-data>
        @foreach($types as $type)
        <div wire:click='selectType({{$type->id}})' :class="{'ring-2 ring-blue-600' : {{$selectedType}} === {{$type->id}}}" class="col-span-1 rounded-lg shadow-md cursor-pointer stat max-h-auto sm:col-span-2 active:scale-95 bg-white dark:bg-gray-800 transition transform duration-300" >
            <span class="text-2xl font-light text-gray-700 dark:text-gray-50">
                {{$type->name}}
            </span>
            <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">
                {{$budget_tile->where('budget_type_id', $type->id)->count()}}
            </span>
            <span class="text-xs font-light text-gray-700 dark:text-gray-50">
                Últimos 30 dias
            </span>
        </div>
        @endforeach
    </div>
</div>
