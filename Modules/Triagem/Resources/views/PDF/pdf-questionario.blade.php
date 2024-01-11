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
                    Resposta
                </th>
                <th>
                    Observação
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($collection as $questionario)
            <tr>
                <th>
                    {{$questionario['question']}}
                </th>

                <td>
                    {{$questionario['answer']}}
                </td>

                <td>
                    {{$questionario['observation']}}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

<div>
    <h4>Observação da Triagem</h4>
    <p>{{$term->observation}} </p>
</div>

</div>



    <p style="text-align: center;">SIGMA - Ultrimagem Ubá</p>
</body>

</html>
