<x-layout.admin title="Все зоны доставки">
    <a href="{{ route('zone.create') }}">Добавить зону доставки</a> |
    <hr>
    <div class="row">
        @foreach($citiesWithNested as $city)
            <h3>{{$city->city_name}}</h3>
            <table class="table caption-top">

                <thead>
                <tr>
                    <th scope="col">Зона доставки</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="sortable-pickups-{{$city->id}}">
                @foreach($city->deliveryZones as $zone)
                    <tr data-id="{{$zone->id}}">
                        <td>{{ $zone->name }}</td>
                        <td>
                            <a href="{{ route('zone.edit', [ $zone->id ]) }}">Редактировать</a>
                        </td>
                        <td>
                            <x-form method="delete" :action="route('zone.destroy', [ $zone->id ])">
                                <button class="btn btn-danger">Удалить зону</button>
                            </x-form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
</x-layout.admin>
