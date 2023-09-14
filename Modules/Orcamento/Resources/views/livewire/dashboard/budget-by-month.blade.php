<div>
    <div class="w-full">
        <div id="chart">
        </div>
    </div>

    <script>
        var options = {
chart: {
type: 'bar',
stacked:true,
height: '320px'
},
title: {
    text: 'Orçamentos por mês'
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

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
    </script>

</div>