<div>
    <div class="flex ">
        now - {{now()}}
        gmdate - {{gmdate('d/m/Y H:i:s')}}
        date - {{date('d/m/Y H:i:s')}}
        timezone - {{config('app.timezone')}}
    </div>
    <div class=" row">
        @livewire('helpdesk::dashboard.ticket-tabs')
    </div>
    <div class="w-full row">
        @livewire('helpdesk::dashboard.ticket-charts')
    </div>
    <div class="w-full row">
        @livewire('helpdesk::dashboard.ticket-stats')
    </div>
    <div class="w-full py-2 mx-auto space-y-2 row">
        @livewire('helpdesk::dashboard.charts.tickets-by-category')
    </div>
</div>