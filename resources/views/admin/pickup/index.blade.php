<x-layout.admin title="Все точки самовывоза">
    <a href="{{ route('pickup.create') }}">Добавить точку</a> |
    <hr>
    <div class="row">
        @foreach($pickups as $pickup)
            <div class="col m-3">
                <div>{{ $pickup->name }}</div>
                <div>{{ $pickup->city->city_name }}</div>
                <a href="{{ route('pickup.edit', [ $pickup->id ]) }}">Редактировать</a>
                <x-form method="delete" :action="route('pickup.destroy', [ $pickup->id ])">
                    <button class="btn btn-danger">Удалить точку</button>
                </x-form>
            </div>
        @endforeach
    </div>
</x-layout.admin>
