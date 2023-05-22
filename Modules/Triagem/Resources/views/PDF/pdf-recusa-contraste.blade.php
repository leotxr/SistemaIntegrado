<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Termo de recusa ao uso do constraste</title>
</head>

<body>
    <header>
        <img src="{{URL::asset('storage/logo/logopdf.png')}}" width="auto" height="60px" />
    </header>
    <h1 class="font-bold text-center" style="text-align: center;">Termo de recusa ao uso do constraste</h1>
    <p>Nome do paciente: {{$term->patient_name}}</p>
    <p>Data de nascimento: {{date('d/m/Y', strtotime($term->patient_age))}}</p>
    <p>Data de emissão: {{date('d-m-Y')}}</p>
    <p>
        <livewire:triagem::termos.termo-recusa-contraste />
    </p>

    <br>
    <p>@php setlocale(LC_ALL, NULL);
        setlocale(LC_ALL, 'pt_BR')
        @endphp
        {{ucfirst(gmstrftime('Ubá %d de %B de %Y'))}}</p>
    <br>

    <br>

    <img src="{{$signature->url}}" width="350px" height="100px"> </img>
    <p>Assinatura do titular ou responsável</p>
    <br>
