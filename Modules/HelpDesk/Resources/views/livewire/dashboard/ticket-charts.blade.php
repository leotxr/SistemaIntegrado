<div>
    <div class="grid gap-3 py-2 mx-auto space-y-2 lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-1">
        <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800 ">
            <x-title>Chamados abertos por dia</x-title>
            <span class="text-xs font-light text-gray-500">Exibe o total de chamados abertos dos nos ultimos 5
                dias</span>
            <div class="h-48" wire:ignore>
                <div id="chartDays">

                </div>
            </div>
        </div>
        <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800 ">
            <x-title>Chamados abertos por setor</x-title>
            <span class="text-xs font-light text-gray-500">Exibe o total de chamados abertos por setor no mês
                atual</span>
            <div class="h-48" wire:ignore>
                <div id="chartGroups">
                </div>
            </div>
        </div>

    </div>

    {{--
    <x-modal.dialog wire:model.defer='modalChart'>
        <x-slot name='title'>
            <x-title> Chamados Abertos </x-title>
        </x-slot>
        <x-slot name='content'>

            @include('helpdesk::dashboard.tables.table-tickets-modal')


        </x-slot>
        <x-slot name='footer' class="space-x-4">

        </x-slot>
    </x-modal.dialog>
    --}}

    <script>
        //CHART AREA TICKETS POR DIA
        var chartDaysOptions = {
  chart: {
    height: 200,
    type: "area"
  },
  dataLabels: {
    enabled: false
  },
  series: [
    {
      name: "Chamados Por Dia",
      data: @json($days_values)
    }
  ],
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.7,
      opacityTo: 0.9,
    }
  },
  xaxis: {
    categories: @json($days_format),
    labels:{
            style:{
                colors:'#6b7280'
            }
          }
  },
        yaxis:{
            labels:{
            style:{
                colors:'#6b7280'
            }
          }
        },
};


var chartDays = new ApexCharts(document.querySelector("#chartDays"), chartDaysOptions);

chartDays.render();

Livewire.on('refreshChart', (chartDaysData) => {
    chartDays.updateSeries([{
        data:chartDaysData.seriesDaysData
    }]);

})

//CHART COLUMN TICKETS POR SETOR

var chartGroupsOptions = {
          series: [{
          name: 'Chamados por setor',
          data: @json($groups_values)
        }],
          chart: {
          type: 'bar',
          height: 200
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '80%'
          },
        },
        dataLabels: {
          enabled: true
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: @json($groups_names),
          labels:{
            style:{
                colors:'#6b7280'
            }
          }
        },
        yaxis:{
            labels:{
            style:{
                colors:'#6b7280'
            }
          }
        },
        fill: {
          opacity: 1
        },
        };

        var chartGroups = new ApexCharts(document.querySelector("#chartGroups"), chartGroupsOptions);
        chartGroups.render();

        Livewire.on('refreshChart', (chartGroupsData) => {
    chartGroups.updateSeries([{
        data:chartGroupsData.seriesGroupsData
    }]);
})
    </script>
</div>