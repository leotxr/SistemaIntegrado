<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>Resumo do processamento de desconto no faturamento de Exames por Médico</title>

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

        footer {
            bottom: 0;
        }
    </style>
</head>
<body>
<header>
    <h2>Resumo do processamento de desconto no faturamento de Exames por Médico</h2>
    <p>Período: {{date('d/m/y', strtotime($start_date))}} até {{date('d/m/y', strtotime($end_date))}}</p>
    <p>Médico: {{$doctor->name}}</p>
</header>
<section>
    <div>
        <table>
            <thead>
            <tr>
                <th>Data Exame</th>
                <th>Fatura</th>
                <th>ID Paciente</th>
                <th>Nome Paciente</th>
                <th>Exame</th>
                <th>Convênio</th>
                <th>Valor</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{date('d/m/y', strtotime($invoice->exam_date))}}</td>
                    <td>{{$invoice->invoice_id}}</td>
                    <td>{{$invoice->patient_id}}</td>
                    <td>{{$invoice->patient_name}}</td>
                    <td>{{$invoice->exam_description}}</td>
                    <td>{{$invoice->insurance}}</td>
                    <td>R$ {{$invoice->total_value}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin-top: 24px">
        <table>
            <thead>
            <tr>
                <th>Total de exames descontados</th>
                <th>Valor Bruto Descontados</th>
                <th>Percentual de Desconto</th>
                <th>Valor Líquido Desconto</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$invoices->count()}}</td>
                <td>{{number_format((float)$discount_value, 2, '.', '')}}</td>
                <td>{{$discount_percent}}%</td>
                <td>{{number_format((float)$liquid_discount_value, 2, '.', '')}}</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div style="margin-top: 24px">
        <table>
            <thead>
            <tr>
                <th>Total de exames pagos</th>
                <th>Valor Bruto Pagos</th>
                <th>Percentual de Pagamento</th>
                <th>Valor Líquido Pagamento</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$invoices_payment->count()}}</td>
                <td>{{number_format((float)$payment_value, 2, '.', '')}}</td>
                <td>{{$payment_percent}}%</td>
                <td>{{number_format((float)$liquid_payment_value, 2, '.', '')}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</section>
<footer>
    <p>{{now()->format('d/m/y H:i:s')}}</p>
</footer>
</body>
</html>
