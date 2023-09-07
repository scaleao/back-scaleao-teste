<html>
    <head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #D6EEEE;
        }
        </style>
    </head>
    <body>
        <h1>{{ $seller->name }} seu relatorio diario:</h1>
        @if(count($seller->sale) == 0)
            <p>Não foi encontrado registro de venda</p>
        @else
            <table style="width:100%">
                <tr>
                    <th>Data da Venda</th>
                    <th>Valor da Venda</th>
                    <th>Comissão</th>
                </tr>
                @foreach($seller->sale as $venda)
                    <tr>
                        <td>{{ $venda->created_at }}</td>
                        <td>{{ $venda->amount}}</td>
                        <td>{{ $venda->comission }}</td>
                    <tr>
                @endforeach()
                </tr>
            </table>
        @endif
    </body>
</html>