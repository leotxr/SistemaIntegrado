<div class="py-6 space-y-6 max-w-full sm:py-6" wire:poll.10000ms>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <x-dashboard-container>
            <x-slot:title>Triagens realizadas RM</x-slot:title>
            <x-slot:description>Mostra as triagens realizadas dos últimos 5 dias</x-slot:description>
            <x-slot:content>
                <div id="chartRM" wire:ignore>

                </div>
            </x-slot:content>
        </x-dashboard-container>
        <x-dashboard-container>
            <x-slot:title>Triagens realizadas RM Sub</x-slot:title>
            <x-slot:description>Mostra as triagens realizadas dos últimos 5 dias</x-slot:description>
            <x-slot:content>
                <div id="chartRMSub" wire:ignore>

                </div>
            </x-slot:content>
        </x-dashboard-container>
        <x-dashboard-container>
            <x-slot:title>Triagens realizadas TC</x-slot:title>
            <x-slot:description>Mostra as triagens realizadas dos últimos 5 dias</x-slot:description>
            <x-slot:content>
                <div id="chartTC" wire:ignore>

                </div>
            </x-slot:content>
        </x-dashboard-container>
    </div>
    <script>
        //RM
        var chartOptionsRM = {
            series: [{
                name: 'Triagens realizadas RM',
                data: @json($rm_values)
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
                categories: @json($days),
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
        };

        var chartRM = new ApexCharts(document.querySelector("#chartRM"), chartOptionsRM);
        chartRM.render();

        //RM Sub
        var chartOptionsRMSub = {
            series: [{
                name: 'Triagens realizadas RM Sub',
                data: @json($rm_sub_values)
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
                categories: @json($days),
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
        };

        var chartRMSub = new ApexCharts(document.querySelector("#chartRMSub"), chartOptionsRMSub);
        chartRMSub.render();

        //TC
        var chartOptionsTC = {
            series: [{
                name: 'Triagens realizadas TC',
                data: @json($tc_values)
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
                categories: @json($days),
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
        };

        var chartTC = new ApexCharts(document.querySelector("#chartTC"), chartOptionsTC);
        chartTC.render();
    </script>
</div>
