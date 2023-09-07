<x-mail::message>
# {{ $seller->name }} seu relatorio diario:

@if(count($seller->sale) == 0)
- Não foi encontrado registro de venda
@else
<x-mail::table>
| Data da Venda | Valor da Venda | Comissão |
| ------ | ------ | ------ |
@foreach($seller->sale as $venda)
| {{ $venda->created_at }} | {{ $venda->amount}} | {{ $venda->comission }} |
@endforeach()
| Total: | {{ $seller->saleTotalDaily }} | {{ $seller->comissionTotalDaily }} |
</x-mail::table>
@endif
</x-mail::message>
