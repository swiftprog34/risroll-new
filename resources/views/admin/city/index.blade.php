<x-layout.admin title="Все города">
    <a href="{{ route('city.create') }}">Добавить город</a> |
    <hr>
    <div class="row">
        @foreach($cities as $city)
            <div class="col m-3">
                <div>{{ $city->slug }}</div>
                <div>{{ $city->city_name }}</div>
                <a href="{{ route('city.edit', [ $city->id ]) }}">Редактировать</a>
            </div>
        @endforeach
    </div>
</x-layout.admin>
