<div>

    <header>
        <div class="grid grid-cols-2 gap-2 justify-between">
            <div class="col-span-1">
                <p class=" text-md text-black"><strong>Código:</strong> {{$patient_id}}</p>
                <p class=" text-md text-black"><strong>Nome:</strong> {{$patient_name}}</p>
            </div>
            <div class="col-span-1 text-end">
                <p class=" text-md text-black"><strong>Data do exame:</strong> {{$exam_date}}</p>
                <p class=" text-md text-black"><strong>Médico Assinante:</strong> {{$doctor}}</p>
            </div>
        </div>
    </header>
    <body>
    @php
        echo $report;
    @endphp
    </body>
    <footer>
        <div class="bottom-0  w-full">
            <p class=" text-md text-black justify-self-end"><strong>Laudado por:</strong> {{$doctor}}</p>
            <p><i>Usuário: {{auth()->user()->name}}</i></p>
            <p>{{now()->format('d/m/Y H:i:s')}}</p>
        </div>
    </footer>
</div>>
