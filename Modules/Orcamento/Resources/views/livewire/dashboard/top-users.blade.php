<div>
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-7">
        <div class="col-span-4 overflow-auto bg-white max-h-80 dark:bg-gray-800">
            <x-table>
                <x-slot name="head">
                    <x-table.heading>Atendente</x-table.heading>
                    <x-table.heading>Agendados</x-table.heading>
                    <x-table.heading>Não Agendados</x-table.heading>
                    <x-table.heading>Pendentes</x-table.heading>
                    <x-table.heading>Total</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach($users as $user)
                    <x-table.row>
                        <x-table.cell>{{$user->name}}</x-table.cell>
                        <x-table.cell>{{$user->relBudgets->where('budget_status_id', 3)->count()}}</x-table.cell>
                        <x-table.cell>{{$user->relBudgets->where('budget_status_id', 2)->count()}}</x-table.cell>
                        <x-table.cell>{{$user->relBudgets->where('budget_status_id', 1)->count()}}</x-table.cell>
                        <x-table.cell>{{$user->relBudgets->count()}}</x-table.cell>
                    </x-table.row>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
        <div class="col-span-3 p-2 bg-white" id="top_users">

        </div>
    </div>


    <script>
        var options = {
      series: @json($values),
      chart: {
        width: 380,
        type: "pie"
      },
      labels: @json($user_names),
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: "bottom"
            }
          }
        }
      ]
    }

var chart = new ApexCharts(document.querySelector("#top_users"), options);

chart.render();
    </script>
</div>