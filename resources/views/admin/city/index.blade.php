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
            <x-form method="post" :action="route('fetch.mobidel.data', [
                    'restaurantID'  => $city->restaurant_id,
                    'wid'           => $city->w_id,
                    'cityId'        => $city->id ])">
                <button class="btn btn-success">Обновить данные о Категориях и Товарах из Mobidel</button>
            </x-form>
        @endforeach
    </div>
</x-layout.admin>
