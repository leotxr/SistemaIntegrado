<div class="overflow-hidden rounded-lg shadow-lg">

  <canvas class="p-2" id="chartHpac"></canvas>
</div>

<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart line -->
<script>
  //teste com numeros aleatorios
  var n = [];
  for(var i=0; i<16; i++) 
  {
    n.push(Math.floor(Math.random() * 30));
  };
  //fimteste

    var labels = ["6:00", "7:00", "8:00", "9:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00"];
    var data = {
      labels: labels,
      datasets: [
        {
          label: "Atendimentos",
          backgroundColor: "hsl(217, 57%, 51%)",
          borderColor: "hsl(217, 57%, 51%)",
          data: n,
        },
      ],
    };
  
    var configChartHpac = {
      type: "line",
      data,
      options: {},
    };
  
    var chartHpac = new Chart(
      document.getElementById("chartHpac"),
      configChartHpac
    );
</script>