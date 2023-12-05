<div>
    <x-table>
        <x-slot name="head">
            <x-table.heading>Data</x-table.heading>
            <x-table.heading>Código</x-table.heading>
            <x-table.heading>Paciente</x-table.heading>
            <x-table.heading>Exame</x-table.heading>
            <x-table.heading>Convênio</x-table.heading>
            <x-table.heading>Solicitante</x-table.heading>
            <x-table.heading>Último usuário</x-table.heading>
            <x-table.heading>Status</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach($protocols as $protocol)
                @php
                    $exams = $protocol->find($protocol->id)->exams;
                    $requester = $protocol->find($protocol->id)->requester;
                    $last_user = $protocol->find($protocol->id)->updater;
                @endphp
                @foreach($exams->whereIn('exam_status_id', $activeStatus) as $exam)
                    <x-table.row>
                        <x-table.cell>{{$protocol->created_at}}</x-table.cell>
                        <x-table.cell>{{$protocol->id}}</x-table.cell>
                        <x-table.cell>{{$protocol->paciente_name}}</x-table.cell>
                        <x-table.cell>{{$exam->name}}</x-table.cell>
                        <x-table.cell>{{$exam->convenio}}</x-table.cell>
                        <x-table.cell>{{$requester->name}}</x-table.cell>
                        <x-table.cell>{{$last_user->name}}</x-table.cell>
                        <x-table.cell>{{$exam->examStatus->name}}</x-table.cell>
                    </x-table.row>
                @endforeach
            @endforeach
        </x-slot>
    </x-table>
</div>
