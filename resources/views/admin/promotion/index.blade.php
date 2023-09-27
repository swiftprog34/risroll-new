<x-layout.admin title="Все Акции">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <a href="{{ route('promotion.create') }}">Добавить акцию</a> |
    <hr>
    <div class="row">
        @foreach($citiesWithNested as $city)
            <h3>{{$city->city_name}}</h3>
            <table class="table caption-top">
                <thead>
                <tr>
                    <th scope="col">Акция</th>
                    <th scope="col">Видимость на сайте</th>
                </tr>
                </thead>
                <tbody id="sortable-promotions-{{$city->id}}">
                @foreach($city->promotions as $promotion)
                    <tr data-id="{{$promotion->id}}">
                        <td>{{ $promotion->name }}</td>
                        <td>{{ $promotion->is_active }}</td>
                        <td><a href="{{ route('promotion.edit', [ $promotion->id ]) }}">Редактировать</a></td>
                        <td><x-form method="delete" :action="route('promotion.destroy', [ $promotion->id ])">
                            <button class="btn btn-danger">Удалить акцию</button>
                        </x-form></td>
                    </tr>
                @endforeach
                </tbody>
                <script>
                    function updateToDatabaseCategory(idString) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });

                        $.ajax({
                            url: '{{ url("administrator/promotion/update-order") }}',
                            method: 'POST',
                            data: {
                                ids: idString
                            }
                        })
                    }


                    $('#sortable-promotions-{{$city->id}}').sortable({
                        update: function() {
                            var sortData = $('#sortable-promotions-{{$city->id}}').sortable('toArray', {
                                attribute: 'data-id'
                            })
                            updateToDatabaseCategory(sortData.join(','))
                        }
                    })
                </script>
            </table>
        @endforeach
    </div>
</x-layout.admin>
