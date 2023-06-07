<x-tab>
    <x-slot name='head'>
        <x-tab.nav id='novos' :class="{'active':tab === 'novos'}" @click.prevent="tab = 'novos';">
            Novos Chamados
        </x-tab.nav>
        <x-tab.nav id="vinculados">
            Chamados Vinculados
        </x-tab.nav>
        <x-tab.nav id="pausados">
            Chamados Pausados
        </x-tab.nav>
    </x-slot>
    <x-slot name='content'>
        <x-tab.content id='novos'>
            teste novo
        </x-tab.content>
        <x-tab.content id="vinculados">
            teste vinc
        </x-tab.content>
        <x-tab.content id="pausados">
            teste pausa
        </x-tab.content>
    </x-slot>
</x-tab>