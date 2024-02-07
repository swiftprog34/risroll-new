<h1>Новый заказ № {{$order->id}} от {{$order->created_at}}</h1>
<br>
<h3>Покупатель: {{$order->username}}</h3>
<h3>Контактный телефон: {{$order->phone}}</h3>
<br>
<table>
    <thead>
        <tr>
            <td>Товар</td>
            <td>Количество</td>
            <td>Цена</td>
            <td>Сумма</td>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td>Подытог:</td>
            <td></td>
            <td></td>
            <td>{{$order->total_sum_without_delivery}}</td>
        </tr>
        @if($order->location === null)
        <tr>
            <td>Доставка:</td>
            <td></td>
            <td></td>
            <td>{{$order->delivery_price}}</td>
        </tr>
        @else
        <tr>
            <td>Самовывоз:</td>
            <td></td>
            <td></td>
            <td>0</td>
        </tr>
        @endif
        <tr>
            <td>Итого:</td>
            <td></td>
            <td></td>
            <td>{{$order->total_sum}}</td>
        </tr>
    </tfoot>
    <tbody>
        @foreach($order->products as $product)
            <tr>
                <td>{{$product->title}}</td>
                <td>{{$product->pivot->quantity}}</td>
                <td>{{$product->pivot->price}}</td>
                <td>{{$product->pivot->price * $product->pivot->quantity}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<h3>Способ оплаты: {{$order->pay_type}}</h3>
<h3>Количество персон: {{$order->persons}}</h3>
@if($order->location !== null)
<h3>Точка самовывоза: {{$order->location->name}}</h3>
@else
    <h3>Доставка по адресу:улица {{$order->street}}, дом {{$order->home}}, квартира {{$order->apart}},
        подьезд {{$order->entrance}}, этаж {{$order->floor}}</h3>
    <h3>если нужно, {{$order->datetime}}, на дату/время {{$order->toDate}} / {{$order->toTime}}</h3>
@endif
<h3>Комментарий к заказу: {{$order->comment}}</h3>
