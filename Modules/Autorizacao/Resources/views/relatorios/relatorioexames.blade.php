<head>
    @livewireStyles
</head>
@if(auth()->user()->id)
<body>
    @livewireScripts
    <livewire:autorizacao::layouts.app />
    <div name="header">
        <h2 class="font-semibold text-2xl leading-tight">
            {{ __('Relatório de Solicitações') }}
        </h2>
    </div>

    <div class="py-12" id="teste">
        <div class="max-w-screen-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 font-bold">

                    <div>
                        teste
                    </div>
                    
                    <div>
                        teste
                    </div>
                    
                    <div>
                        teste
                    </div>
                    
                    <div>
                        teste
                    </div>
                    </div>
                </div>

                <div class="p-6 ">
                    <div class="border border-2 responsive" id="table-autorizacao">

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
@else
<script>
    window.location.href = "{{ url('/')}}"
</script>
@endif


<script>
    $(document).ready(function() {
        $(".btn-status").click(function() {
            const url = "{{ route('showlistaut') }}";
            status = $(this).attr('data-value');
            $.ajax({
                url: url,
                data: {
                    'status': status,
                },
                success: function(data) {
                    $("#table-autorizacao").html(data);
                }
            });
        });
    });
</script>
