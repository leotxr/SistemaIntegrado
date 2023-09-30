<div>
    <div
        class="grid w-full grid-cols-2 gap-1 px-2 py-4 bg-white divide-x-2 shadow-sm dark:bg-gray-800 sm:grid-cols-8 divide-solid">
        <div class="col-span-2 text-center sm:col-span-2">
            <div>
                <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$budgets->count()}}</span>
            </div>
            <div>
                <span class="text-gray-500 text-md font-regular dark:text-gray-200">Solicitações</span>
            </div>
        </div>
        @foreach($types as $type)
        <div class="col-span-2 text-center sm:col-span-2">
            <div>
                <span class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$budgets->where('budget_type_id',
                    $type->id)->count()}}</span>
            </div>
            <div>
                <span class="text-gray-500 text-md font-regular dark:text-gray-200">{{$type->name}}</span>
            </div>
        </div>
        @endforeach
    </div>
    <div class="grid w-full grid-cols-2 gap-1 px-2 py-2 sm:grid-cols-8">
        <div class="grid grid-cols-2 col-span-2 gap-1 sm:col-span-5 sm:grid-cols-6">
            @foreach($statuses as $status)
            <div class="grid content-center col-span-1 py-4 text-center bg-white shadow-sm h-36 sm:col-span-2 dark:bg-gray-800">
                <div>
                    <span
                        class="text-4xl font-bold text-gray-700 dark:text-gray-50">{{$budgets->where('budget_status_id',
                        $status->id)->count()}}</span>
                </div>
                <div>
                    <span class="text-gray-500 text-md font-regular dark:text-gray-200">{{$status->name}}</span>
                </div>

            </div>
            @endforeach
        </div>
        <div class="grid content-center col-span-2 bg-white sm:col-span-3 dark:bg-gray-800" wire:ignore>
            <div id="chartStats">

            </div>
        </div>
    </div>

    <script>
        var options = {
  chart: {
    type: 'pie',
    width: 400,
    id: 'chartStats'
  },
  series: @json($budgetsChart),
    labels: @json($statusesChart),
    theme: {
      mode: 'light', 
      palette: 'palette3', 
      monochrome: {
          enabled: false,
          color: '#255aee',
          shadeTo: 'light',
          shadeIntensity: 0.65
      },
  },
  responsive: [{
    breakpoint: 400,
    options: {
        chart:{
        width: 320,
        height: 400
        }
    },
}]
}

var chartStats = new ApexCharts(document.querySelector("#chartStats"), options);

chartStats.render();

Livewire.on('refreshChart', (chartData) => {


    ApexCharts.exec("chartStats", 'updateSeries',
    chartData.seriesData
)

})
    </script>

</div>