<div >
    <div class="grid grid-cols-1 gap-4 mx-2 font-bold sm:grid-cols-6 " wire:poll='selectStatus({{$activeStatus}})'>
        @php
        $colors = ['black', '#00C510', '#447FFF', '#8978D9', '#B2B2B2', '#FFBD33', '#FF5733'];
        @endphp
        @foreach($statuses as $status)
        <div wire:click='selectStatus({{$status->id}})' class="cursor-pointer active:scale-95">
            <div class="rounded-lg shadow-md stat max-h-auto glass" style="background-color: {{$colors[$status->id]}};">
                <div class="font-bold">{{$status->name}}</div>
                <div class="text-gray-800 stat-value">
                    @php
                    $count = \Modules\Autorizacao\Entities\Exam::where('exam_status_id', $status->id);
                    if($status->id == 1 || $status->id == 4)
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
    <div class="w-full p-6">
        <div class="border responsive">
            @include('autorizacao::tables.table-autorizacao-status')
        </div>
    </div>
</div>
