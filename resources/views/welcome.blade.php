<x-app-layout>
    <div class="text-center grid place-content-center py-20">
        @php
            $items =
                collect([
        ['id' => 1, 'label' => 'Autorização', 'link' => 'autorizacao.index', 'icon' => 'document-stack', 'bg' => 'bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-green-300 to-green-500', 'permission' => 'criar autorizacao'],
        auth()->user()->can('editar chamado') ?
        ['id' => 2, 'label' => 'Chamados', 'link' => 'helpdesk.index', 'icon' => 'helpdesk', 'bg' => 'bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-sky-400 to-blue-500', 'permission' => 'editar chamado']
        :
        ['id' => 2, 'label' => 'Chamados', 'link' => 'helpdesk.guest.index', 'icon' => 'helpdesk', 'bg' => 'bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-sky-400 to-blue-500', 'permission' => 'abrir chamado']
        ,
        ['id' => 3, 'label' => 'Administrativo', 'link' => 'administrativo.index', 'icon' => 'monitor', 'bg' => 'bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-orange-400 to-rose-400', 'permission' => 'acessar administrativo'],
        ['id' => 4, 'label' => 'Triagem', 'link' => 'triagem.index', 'icon' => 'beaker', 'bg' => 'bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-violet-300 to-violet-400', 'permission' => 'criar triagem'],
        ['id' => 5, 'label' => 'Encaixes', 'link' => 'orcamento.index', 'icon' => 'notebook', 'bg' => 'bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-rose-300 to-rose-500', 'permission' => 'criar orcamento'],
        ['id' => 6, 'label' => 'Não Conformidades', 'link' => 'nc.index', 'icon' => 'exclamation-circle', 'bg' => 'bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-yellow-300 to-yellow-500', 'permission' => 'criar ncs'],
        ['id' => 7, 'label' => 'Laudo', 'link' => 'laudo.index', 'icon' => 'document-text', 'bg' => 'bg-gradient-to-r from-orange-300 to-rose-300', 'permission' => 'acessar laudo'],
        ['id' => 8, 'label' => 'Recepção', 'link' => 'recepcao.index', 'icon' => 'book-open', 'bg' => 'bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-sky-600 to-blue-700', 'permission' => 'acessar recepção'],
        ['id' => 9, 'label' => 'Sistema', 'link' => 'dashboard', 'icon' => 'cog', 'bg' => 'bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-gray-900 to-gray-600 bg-gradient-to-r', 'permission' => 'ver configuracoes'],
    ]);
        @endphp
        <h1 class="pb-6 text-2xl font-bold dark:text-white text-gray-700 ">Olá {{ auth()->user()->name }}</h1>
        <ul class="text-white grid grid-cols-6 sm:grid-cols-6 sm:gap-4 gap-2">
            @foreach($items as $item)
                @can($item['permission'])
                    <div class="sm:col-span-2 col-span-2">
                        <a type="button"
                           class="cursor-pointer w-full h-full grid place-items-center hover:bg-gray-50 dark:hover:bg-gray-800 hover:shadow-md transition transform duration-300 p-2"
                           href="{{route($item['link'])}}">
                            <div class="sm:p-2 p-1 rounded-full grid place-items-center {{$item['bg']}}">
                                <x-icon name="{{$item['icon']}}" class="sm:w-12 sm:h-12 w-5 h-5 m-2 "></x-icon>
                            </div>
                            <span
                                class="font-regular sm:text-xl text-xs text-gray-800 dark:text-white">{{$item['label']}}</span></a>
                    </div>
                @endcan
            @endforeach


        </ul>
    </div>

</x-app-layout>
