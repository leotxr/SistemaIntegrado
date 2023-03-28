<div class="mb-4 border-b border-gray-200 dark:border-gray-700">
    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent"
        role="tablist">
        <li class="mr-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="chamados-novos-tab"
                data-tabs-target="#chamados-novos" type="button" role="tab" aria-controls="chamados-novos"
                aria-selected="false">Novos Chamados
                <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                    {{$count_abertos}}
                  </span>
            </button>
        </li>
        <li class="mr-2" role="presentation">
            <button
                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="em-atendimento-tab" data-tabs-target="#em-atendimento" type="button" role="tab"
                aria-controls="em-atendimento" aria-selected="false">Em atendimento
                <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                    {{$count_atendimento}}
                  </span>
                </button>
        </li>
        <li class="mr-2" role="presentation">
            <button
                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="pausados-tab" data-tabs-target="#pausados" type="button" role="tab" aria-controls="pausados"
                aria-selected="false">Pausados</button>
        </li>
        <li class="mr-2" role="presentation">
            <button
                class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                id="vinculados-tab" data-tabs-target="#vinculados" type="button" role="tab" aria-controls="vinculados"
                aria-selected="false">Vinculados</button>
        </li>
        <li role="presentation" class="absolute right-10 ">
            <button type="button" class="btn bg-gray-200 hover:bg-gray-400 btn-sm btn-square border-transparent">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                  </svg>                  
            </button>
        </li>
    </ul>
</div>
<div id="myTabContent">
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="chamados-novos" role="tabpanel"
        aria-labelledby="chamados-novos-tab">
        @include('helpdesk::layouts.partials.painel.tables.table-novos')
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="em-atendimento" role="tabpanel"
        aria-labelledby="em-atendimento-tab">
        @include('helpdesk::layouts.partials.painel.tables.table-em-atendimento')
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="pausados" role="tabpanel"
        aria-labelledby="pausados-tab">
        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                class="font-medium text-gray-800 dark:text-white">Settings tab's associated content</strong>. Clicking
            another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
            the content visibility and styling.</p>
    </div>
    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="vinculados" role="tabpanel"
        aria-labelledby="vinculados-tab">
        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking
            another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control
            the content visibility and styling.</p>
    </div>
</div>