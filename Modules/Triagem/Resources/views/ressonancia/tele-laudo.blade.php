@extends('triagem::layouts.master')
@section('content')
    <div>
        <div class="border border-dashed mb-24">
            <form method="POST" action='{{ route('store.termo-tele-laudo', ['id' => $term->id]) }}'>
                @csrf
                <div id="print" class="container">
                    <div class="row">
                        <div class="col-12 p-5">
                            @livewire('triagem::term-header', ['paciente' => "$term->patient_name", 'data_nascimento' => "$term->patient_age", 'inicio_triagem' => '', 'data_exame' => '', 'procedimento' => "$term->proced", 'pacienteid' => "$term->patient_id"])

                        </div>

                        <div class="col-12 p-5">
                            <livewire:triagem::termos.termo-tele-laudo />
                            @livewire('triagem::checkbox-group', ['label' => 'Eu li e concordo com o ', 'link' => 'Termo de consentimento para exames encaminhados para Telelaudo'])
                        </div>
                    </div>

                    @php
                        $files = $term->find($term->id)->relTermFiles;
                    @endphp
                    @foreach ($files as $file)
                        @php
                            $file_type = $file->find($file->id)->relTypes;
                        @endphp

                        @if ($file_type->id == 5)
                            <div id="footer-assinatura" class="col-12 p-5">
                                @livewire('triagem::term-footer', ['data_exame' => "$term->exam_date", 'title' => 'Assinatura do titular ou responsável', 'description' => '', 'img' => "$file->url"])
                            </div>
                        @endif
                    @endforeach

                </div>

                @livewire('triagem::bottom-navigation', ['submit_title' => 'Assinar e Salvar'])
            </form>
        </div>

        @livewire('triagem::modal-signature', ['title' => 'Assinatura do Titular ou Responsável'])
    </div>
@endsection
<script>
    $("#aceite-termo").click(function() {
        $("#sign").toggleClass("hidden");
    })
</script>
