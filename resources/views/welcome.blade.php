<x-app-layout>
    <div class="text-center grid place-content-center py-20">
        <h1 class="pb-6 text-2xl font-bold dark:text-white text-gray-700">Olá {{ auth()->user()->name }}</h1>
        <ul class="text-white grid grid-cols-2 sm:grid-cols-6 gap-4" x-data="{ colors: [
                    { id: 1, label: 'Autorização', link: '{{route('autorizacao.index')}}', image: '{{ URL::asset('storage/icons/autorizacao.png') }}' },
                    @can('editar chamado')
                    { id: 2, label: 'Chamados', link: '{{route('helpdesk.index')}}', image: '{{ URL::asset('storage/icons/ti.png') }}' },
                    @else
                    { id: 2, label: 'Chamados', link: '{{route('helpdesk.guest.index')}}', image: '{{ URL::asset('storage/icons/ti.png') }}' },
                    @endcan
                    { id: 3, label: 'Administrativo', link: '{{route('administrativo.index')}}', image: '{{ URL::asset('storage/icons/requisicao.png') }}' },
                    @can('criar triagem')
                    { id: 4, label: 'Triagem', link: '{{route('triagem.index')}}', image: '{{ URL::asset('storage/icons/triagem.png') }}' },
                    @endcan
                    @can('criar orcamento')
                    { id: 5, label: 'Encaixes', link: '{{route('orcamento.index')}}', image: '{{ URL::asset('storage/icons/encaixes.png') }}' },
                    @endcan
                    { id: 6, label: 'Não Conformidades', link: '{{route('nc.index')}}', image: '{{ URL::asset('storage/icons/check.png') }}' },
                    { id: 7, label: 'Gestão', link: '{{route('gestao.index')}}', image: '{{ URL::asset('storage/icons/requisicao.png') }}' },
                    @can('ver configuracoes')
                    { id: 8, label: 'Sistema', link: '{{route('dashboard')}}', image: '{{ URL::asset('storage/icons/seguranca.png') }}' },
                    @endcan
                       ]}">
            <template x-for="color in colors" :key="color.id">

                    <div class="sm:col-span-2 col-span-2">
                        <a type="button" class="cursor-pointer inline-flex place-items-center w-full dark:border rounded-lg dark:bg-gray-800 dark:border-gray-700 p-2 dark:hover:bg-gray-700 dark:hover:ring-2 dark:hover:ring-inset dark:hover:ring-blue-800 dark:hover:shadow-sm hover:ring-2 hover:ring-inset hover:ring-blue-300 transition transform duration-300"
                           :href="color.link">
                            <img :src="color.image" class="w-8 h-8 m-2">
                            <span class="font-regular text-xl text-gray-800 dark:text-white" x-text="color.label"></span></a>
                    </div>

            </template>
        </ul>
    </div>

</x-app-layout>
