<div >
    <div class="grid grid-cols-1 sm:grid-cols-6 gap-4 mx-2 font-bold " wire:poll='selectStatus({{$activeStatus}})'>
        @foreach($statuses as $status)
        <div wire:click='selectStatus({{$status->id}})' class="cursor-pointer active:scale-95">
            <div class="stat shadow-md max-h-auto rounded-lg bg-{{$colors[$status->id]}}-400 ">
                <div class="font-bold">{{$status->name}}</div>
                <div class="stat-value text-gray-900">
                    @php
                    $count = \Modules\Autorizacao\Entities\Exam::where('exam_status_id', $status->id);
                    if($status->id == 1 || $status->name == 'Autorizado')
                    {
                        $count = $count->whereDate('updated_at', date('Y-m-d'));
                    }
                        $count = $count->count();
                @endphp
                {{$count}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="p-6 w-full">
        <div class="border responsive">
            @include('autorizacao::tables.table-autorizacao-status')
        </div>
    </div>
</div>
