<div class="text-sm divide-y-2 space-y-2">
    <div>
        <p class="font-bold">Resumo do processamento de desconto no faturamento de Exames por Médico</p>
        <p>Período: 01/01/2024 até 31/12/2024</p>
        <p>Filtro: Nome do médico</p>
    </div>
    <div>
        <x-table>
            <x-slot name="head">
                <x-table.heading>Data Exame</x-table.heading>
                <x-table.heading>Fatura</x-table.heading>
                <x-table.heading>ID Paciente</x-table.heading>
                <x-table.heading>Nome Paciente</x-table.heading>
                <x-table.heading>Exame</x-table.heading>
                <x-table.heading>Convênio</x-table.heading>
                <x-table.heading>Valor</x-table.heading>
            </x-slot>
            <x-slot name="body">
                <x-table.row>
                    <x-table.cell></x-table.cell>
                    <x-table.cell></x-table.cell>
                    <x-table.cell></x-table.cell>
                    <x-table.cell></x-table.cell>
                    <x-table.cell></x-table.cell>
                    <x-table.cell></x-table.cell>
                    <x-table.cell></x-table.cell>
                </x-table.row>
            </x-slot>
        </x-table>
    </div>
    <div class="w-full">
        <p>Data do processamento: 01/01/2024 00:00:00</p>
        <p>Total de exames processados: 11</p>
        <p>Valor Total: R$</p>
        <p>Percentual de Desconto: %</p>
        <p>Valor Descontado: R$</p>
    </div>
</div>

