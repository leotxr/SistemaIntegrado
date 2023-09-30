<div>
  <div class="grid grid-cols-1 gap-1 px-2 py-2 sm:grid-cols-8">
    <div class="col-span-1 overflow-auto bg-white sm:col-span-5 dark:bg-gray-800">
      <x-table>
        <x-slot name="head">
          <x-table.heading>Atendente</x-table.heading>
          @foreach($statuses as $status)
          <x-table.heading>{{$status->name}}</x-table.heading>
          @endforeach
          <x-table.heading>Total</x-table.heading>
        </x-slot>
        <x-slot name="body">
          @foreach($users as $user)
          @if($user->budgets->count() > 0)
          <x-table.row>
            <x-table.cell>{{$user->name}}</x-table.cell>
            @foreach($statuses as $status)
            <x-table.cell>
              {{$orcamentos->where('initial_status_id', $status->id)->where('user_id', $user->id)->count()}}
            </x-table.cell>
            @endforeach
            <x-table.cell class="font-bold">
              {{$orcamentos->where('user_id', $user->id)->count()}}
          </x-table.cell>
          </x-table.row>
          @endif
          @endforeach

        </x-slot>
      </x-table>
    </div>
    <div class="grid content-center col-span-1 p-2 bg-white sm:col-span-3" wire:ignore>
      <div id="chartUsers">
      </div>

    </div>
  </div>


  <script>
    var chartUserOptions = {
  chart: {
    type: 'pie',
    width: 400,
    id: 'chartUsers'
  },
  series: @json($values),
    labels: @json($user_names),
    theme: {
      mode: 'light', 
      palette: 'palette4', 
      monochrome: {
          enabled: false,
          color: '#255aee',
          shadeTo: 'light',
          shadeIntensity: 0.65
      },
  },
  responsive: [{
    breakpoint: 400,
    options: {
        chart:{
        width: 320,
        height: 400
        }
    },
}]
}

var chartUsers = new ApexCharts(document.querySelector("#chartUsers"), chartUserOptions);

chartUsers.render();


Livewire.on('refreshUserChart', (chartUserData) => {
  ApexCharts.exec("chartUsers", 'updateSeries',
    chartUserData.seriesUserData
  )

})


  </script>
</div>