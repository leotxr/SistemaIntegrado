<!DOCTYPE html>
<html>

<head>
    <title>Termo de consentimento para uso de Contraste</title>
</head>

<body>
    <header>
        LOGO
    </header>
    <h1 class="text-center font-bold" style="text-align: center;">Termo de consentimento para uso de Contraste</h1>
    <p>Nome do paciente: {{$term->patient_name}}</p>
    <p>Data de nascimento: {{date('d/m/Y', strtotime($term->patient_age))}}</p>
    <p>
        <livewire:triagem::termos.termo-contraste-ressonancia />
    </p>

    <br>
    <img src="{{$signature->url}}" width="350px" height="100px"> </img>
    <p>Assinatura do titular ou responsável</p>
    <br>

    <p style="text-align: center;">Ultrimagem Ubá</p>
</body>

</html>