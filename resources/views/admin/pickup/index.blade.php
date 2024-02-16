<x-layout.admin title="Все точки самовывоза">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <a href="{{ route('pickup.create') }}">Добавить точку</a> |
    <hr>
    <div class="row">
        @foreach($citiesWithNested as $city)
            <h3>{{$city->city_name}}</h3>
            <table class="table caption-top">

                <thead>
                <tr>
                    <th scope="col">Точка самовывоза</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody id="sortable-pickups-{{$city->id}}">
                @foreach($city->pickupPoints as $pickup)
                    <tr data-id="{{$pickup->id}}">
                        <td>{{ $pickup->name }}</td>
                        <td>
                            <a href="{{ route('pickup.edit', [ $pickup->id ]) }}">Редактировать</a>
                        </td>
                        <td>
                            <x-form method="delete" :action="route('pickup.destroy', [ $pickup->id ])">
                                <button class="btn btn-danger">Удалить точку</button>
                            </x-form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <script>
                    function updateToDatabasePickup(idString) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });

                        $.ajax({
                            url: '{{ url("administrator/pickup/update-order") }}',
                            method: 'POST',
                            data: {
                                ids: idString
                            }
                        })
                    }


                    $('#sortable-pickups-{{$city->id}}').sortable({
                        update: function() {
                            var sortData = $('#sortable-pickups-{{$city->id}}').sortable('toArray', {
                                attribute: 'data-id'
                            })
                            updateToDatabasePickup(sortData.join(','))
                        }
                    })
                </script>
            </table>
        @endforeach
    </div>
</x-layout.admin>
