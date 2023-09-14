<div>
    <div class="w-full">
        <div id="chart_day" class="max-h-48" >
        </div>
    </div>

    <script>
        var options = {
chart: {
stacked: true,
type: 'bar',
height: '480px'
},
theme: {
    mode: 'light',
    palette: 'palette3'
},
title: {
    text: 'Orçamentos por dia'
},
series: [
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