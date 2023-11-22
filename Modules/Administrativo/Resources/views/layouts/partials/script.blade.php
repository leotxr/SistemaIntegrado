    <!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

    {{--
    {{ module_vite('build-administrativo', 'Resources/assets/css/app.css') }}
    {{ module_vite('build-administrativo', 'Resources/assets/js/app.js') }}
--}}

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    @livewireChartsScripts
    <livewire:scripts />
