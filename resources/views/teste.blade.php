<!DOCTYPE html>
<html>

<head>
    <title>Termo de consentimento para uso de Contraste</title>

    <style>
        .grid-container {
            display: inline-grid;
            grid-template-columns: auto auto auto;
            padding: 10px;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{URL::asset('storage/logo/logopdf.png')}}" width="auto" height="60px" />
       {{-- <x-client-logo style="text-align: center;" width="auto" height="60px" /> --}}
    </header>
    <h1 class="font-bold text-center" style="text-align: center;">Termo de consentimento para uso de Contraste</h1>
    <p>Nome do paciente: </p>
    <p>Data de nascimento: </p>
    <p>
        <livewire:triagem::termos.termo-contraste-ressonancia />
    </p>

    <br>
    <div class="grid-container">
        <div class="grid-item">
            <img src="" width="350px" height="100px"> </img>
            <p>Assinatura do titular ou responsável</p>
        </div>
        <div class="grid-item">
            <p> </p>
            <p>Data do exame</p>
        </div>
    </div>
    <br>

    <p style="text-align: center;">Ultrimagem Ubá</p>
</body>

</html>
