<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

{{--
{{ module_vite('build-administrativo', 'Resources/assets/css/app.css') }}
{{ module_vite('build-administrativo', 'Resources/assets/js/app.js') }}
--}}

<script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

@livewireChartsScripts
<livewire:scripts/>
