<div>
    <div class="grid grid-cols-1 gap-3 text-center justify-items-center sm:grid-cols-6" x-data>
        @foreach($types as $type)
        <div wire:click='selectType({{$type->id}})' :class="{'glass' : {{$selectedType}} === {{$type->id}}}" class="col-span-1 rounded-lg shadow-md cursor-pointer stat max-h-auto sm:col-span-2 active:scale-95 " style="background-color: {{$type->color}}">
            <span class="text-2xl font-light text-white">
                {{$type->name}}
            </span>
            <span class="text-4xl font-bold text-white">
                {{\Modules\Orcamento\Entities\Budget::where('budget_type_id', $type->id)->count()}}
            </span>
            <span class="text-xs font-light text-gray-50">
                Últimos 30 dias
            </span>
        </div>
        @endforeach
    </div>
</div>