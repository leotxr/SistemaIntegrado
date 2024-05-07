<div >
    <x-dashboard-container height="md" width="full" class="overflow-hidden">
        <x-slot:title>Faturas por médico</x-slot:title>
        <x-slot:description>Divisão de faturas por médico</x-slot:description>
        <x-slot:content>
            <div class="flex content-center" id="chartDoctorsMonth">

            </div>
        </x-slot:content>

    </x-dashboard-container>
    <script>
        console.log(document.classList);
        var options = {
            chart: {
                type: 'pie',
                width: 400,
                id: 'chartDoctorsMonth',
                backgroundOpacity: 0

            },
            series: @json($invoices_by_doctor),
            labels: @json($doctors),
            theme: {
                mode: 'light',
                palette: 'palette6',
                monochrome: {
                    enabled: false,
                    color: '#255aee',
                    shadeTo: 'light',
                    shadeIntensity: 0.65
                },
            },
            legend: {
                labels: {
                    colors: '#6b7280',
                    useSeriesColors: true
                },
            },

            responsive: [{
                breakpoint: 420,
                options: {
                    chart: {
                        width: 320,
                        height: 420
                    }
                },
            }]
        }

        var chart = new ApexCharts(document.querySelector("#chartDoctorsMonth"), options);

        chart.render();
    </script>
</div>