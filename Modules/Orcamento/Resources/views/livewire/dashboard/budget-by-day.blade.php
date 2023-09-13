<div>
    <div class="w-full">
        <div id="chart_day" class="max-h-48" >
        </div>
    </div>

    <script>
        var options = {
chart: {
type: 'area',
height: '480px'
},
title: {
    text: 'Orçamentos por dia'
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

var chart = new ApexCharts(document.querySelector("#chart_day"), options);

chart.render();
    </script>

</div>