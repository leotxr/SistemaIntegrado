<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"/>
    <title>{{$title}}</title>

    <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
        </style>
</head>

<body>
    <header>
        <img src="{{URL::asset('storage/logo/logopdf.png')}}" width="auto" height="60px" />
       {{-- <x-client-logo style="text-align: center;" width="auto" height="60px" /> --}}
    </header>
    <h2 class="font-bold text-center" style="text-align: center;">{{$title}}</h2>
    <p>Nome do paciente: {{ $term->patient_name }}</p>
    <p>Data de nascimento: {{ date('d/m/Y', strtotime($term->patient_age)) }}</p>
    
<div>
    <table>
        <thead>
            <tr>
                <th>
                    Pergunta
                </th>
                <th>
                    Quantidade
                </th>
                <th>
                    Dispositivo Intravenoso
                </th>
                <th>
                    Membro da Punção
                </th>
                <th>
                    Via
                </th>
                <th>
                    Lote
                </th>
                <th>
                    Validade
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($collection as $questionario)
            <tr>
                <th>
                    {{$questionario['pergunta']}}
                </th>
                
                <td>
                    {{$questionario['quant']}}
                </td>

                <td>
                    {{$questionario['disp']}}
                </td>

                <td>
                    {{$questionario['membro']}}
                </td>

                <td>
                    {{$questionario['via']}}
                </td>

                <td>
                    {{$questionario['lote']}}
                </td>

                <td>
                    {{$questionario['validade']}}
                </td>
               
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <table>
            <thead>
                <tr>
                    <th>
                        Pergunta
                    </th>
                    <th>
                        Resposta
                    </th>
                    <th>
                        Observacao
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection2 as $questionario)
                <tr>
                    <th>
                        {{$questionario['pergunta']}}
                    </th>
                    
                    <td>
                        {{$questionario['radio']}}
                    </td>
    
                    <td>
                        {{$questionario['observacao']}}
                    </td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="grid-container">
        <div class="grid-item">
            <img src="{{$medico->signature}}" width="150px" height="50px"> </img>
            <p>Dr(a).{{$medico->name}} {{$medico->lastname}}</p>
        </div>
        <div class="grid-item">
            <img src="{{auth()->user()->signature}}" width="150px" height="50px"> </img>
            <p>{{auth()->user()->name}} {{auth()->user()->lastname}}</p>
        </div>
        
        
    </div>

<div>
    <h4>Observação da Triagem</h4>
    <p>{{$term->observation}} </p>
</div>
    
</div>



    <p style="text-align: center;">SIGMA - Ultrimagem Ubá</p>
</body>

</html>
