<x-guest-layout>
    <div class="relative flex justify-center bg-gray-100 items-top dark:bg-gray-900 sm:items-center sm:pt-0">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                <div class="px-4 text-lg tracking-wider text-gray-500 border-r border-gray-400">
                    @yield('icon')
                </div>

                <div class="px-4 text-lg tracking-wider text-gray-500 border-r border-gray-400">
                    @yield('code')
                </div>

                <div class="ml-4 text-lg tracking-wider text-gray-500 uppercase">
                    @yield('message')
                </div>
            </div>
            <div class="my-4 text-center">
                <a href="{{url('/')}}">
                    <x-secondary-button>Voltar à tela inicial</x-secondary-button>
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>