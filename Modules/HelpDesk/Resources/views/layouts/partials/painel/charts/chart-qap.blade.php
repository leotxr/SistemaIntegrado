<div class="overflow-hidden rounded-lg shadow-lg">

    <canvas class="p-2" id="chartQap"></canvas>
</div>

@php
$array=[15, 0, 4, 9, 30];
    
@endphp
<!-- Chart line -->
<script>
    var DataArray = [<?php echo join(',', $array)?>];

    var labels = ["11/03", "12/03", "13/03", "14/03", "15/03", "16/03"];
    var data = {
      labels: labels,
      datasets: [
        {
          label: "Quantidade de atendimentos",
          backgroundColor: "hsl(217, 57%, 51%)",
          borderColor: "hsl(217, 57%, 51%)",
          data: DataArray,
        },
      ],
    };
  
    var configLineChart = {
      type: "line",
      data,
      options: {},
    };
  
    var chartQap = new Chart(
      document.getElementById("chartQap"),
      configLineChart
    );
</script>