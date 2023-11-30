<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a
               class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <x-icon name="home" class="h-3 w-3 mr-2" solid></x-icon>
                Início
            </a>
        </li>
        {{$page}}
    </ol>
</nav>
