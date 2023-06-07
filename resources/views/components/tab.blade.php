<div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700" x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'novos' }" id="tab_wrapper">
    <nav class="flex flex-wrap -mb-px">
        {{$head}}
    </nav>
    {{$content}}
</div>