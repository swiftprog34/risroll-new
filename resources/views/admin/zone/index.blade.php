<x-layout.admin title="Все зоны доставки">
    <a href="{{ route('zone.create') }}">Добавить зону доставки</a> |
    <hr>
    <div class="row">
        @foreach($zones as $zone)
            <div class="col m-3">
                <div>{{ $zone->name }}</div>
                <div>{{ $zone->city->city_name }}</div>
                <a href="{{ route('zone.edit', [ $zone->id ]) }}">Редактировать</a>
                <x-form method="delete" :action="route('zone.destroy', [ $zone->id ])">
                    <button class="btn btn-danger">Удалить зону</button>
                </x-form>
            </div>
        @endforeach
    </div>
</x-layout.admin>
