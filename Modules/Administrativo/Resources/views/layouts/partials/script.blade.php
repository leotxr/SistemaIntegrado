    <!-- Scripts -->
@vite(['Resources/assets/css/app.css', 'Resources/assets/js/app.js'])

    {{-- module_vite('build-estoque', 'Resources/assets/css/app.css') --}}

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    @livewireChartsScripts
    <livewire:scripts />
