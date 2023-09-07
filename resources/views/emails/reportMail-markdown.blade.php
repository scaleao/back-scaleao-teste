<x-mail::message>
# {{ $seller->name }} seu relatorio diario:

@if(count($seller->sales) == 0)
- Não foi encontrado registro de venda
@else
<x-mail::table>
| Data da Venda | Valor da Venda | Comissão |
| ------ | ------ | ------ |
@foreach($seller->sales as $venda)
| {{ $venda->created_at }} | {{ $venda->amount}} | {{ $venda->comission }} |
@endforeach()
| Total: | {{ $seller->total_amount_today }} | {{ $seller->total_commission_today }} |
</x-mail::table>
@endif
</x-mail::message>
