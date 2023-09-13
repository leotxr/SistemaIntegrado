<div>
    <div class="grid w-full grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="col-span-1" id="chart">
        </div>
    </div>

    <script>
        var options = {
chart: {
type: 'area',
stacked: true
},
title: {
    text: 'Orçamentos por mês'
},
series: [{
name: 'Total',
data: @json($total_values)
},
{
name: 'Agendado',
data: @json($agendado)
},
{
name: 'Pendente',
data: @json($pendente)
},
{
name: 'Não Agendado',
data: @json($naoagendado)
},],
xaxis: {
categories: @json($days)
}
}

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
    </script>

</div>