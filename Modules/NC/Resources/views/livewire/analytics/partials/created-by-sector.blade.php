<div>
    <div class="px-4 py-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <x-title>Criadas por setor</x-title>
        <span class="text-xs font-light text-gray-500">Exibe o total de não conformidades criadas por setor.</span>
        <div class="h-48 px-2" wire:ignore>
            <div id="chartCBS">
            </div>
        </div>
    </div>
    <script>
        var optionsCBS = {
            series: [{
                name: 'Chamados por setor',
                data: @json($group_count),
            }],
            chart: {
                type: 'bar',
                height: 200
            },
            theme: {
                palette: 'palette3'
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '80%',
                    distributed: true
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
                categories: @json($group_names),
                labels: {
                    style: {
                        colors: '#6b7280'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#6b7280'
                    }
                }
            },
            fill: {
                opacity: 1
            },
            legend: {
                labels: {
                    colors: '#6b7280',
                    useSeriesColors: true
                },
            }
        };

        var chartCBS = new ApexCharts(document.querySelector("#chartCBS"), optionsCBS);

        chartCBS.render();

        Livewire.on('refreshChartCBS', (chartCBSData) => {
            chartCBS.updateOptions({
                series: [{
                    data: chartCBSData.groupCountCreated,
                }],
                xaxis:{
                    categories: chartCBSData.groupNamesCreated
                }
            });

        })
    </script>
</div>
