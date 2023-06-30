<!DOCTYPE html>
<html>

<head>
    <title>Termo de consentimento para exames encaminhados para Telelaudo</title>
</head>

<body>
    <header>
        <img src="{{URL::asset('storage/logo/logopdf.png')}}" width="auto" height="60px" />
    </header>
    <h1 class="font-bold text-center" style="text-align: center;">Termo de consentimento para exames encaminhados para Telelaudo</h1>
    <p>Nome do paciente: {{$term->patient_name}}</p>
    <p>Data de nascimento: {{date('d/m/Y', strtotime($term->patient_age))}}</p>
    <p>
        <livewire:triagem::termos.termo-tele-laudo />
    </p>

    <br>
    <img src="{{$signature->url}}" width="350px" height="100px"> </img>
    <p>Assinatura do titular ou responsável</p>
    <br>

    <p style="text-align: center;">Ultrimagem Ubá</p>
    <p style="text-align: center;">{{now()}}</p>
</body>

</html>