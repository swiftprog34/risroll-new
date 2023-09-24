<x-layout.admin title="Все Акции">
    <a href="{{ route('promotion.create') }}">Добавить акцию</a> |
    <hr>
    <div class="row">
        @foreach($promotions as $promotion)
            <div class="col m-3">
                <div>{{ $promotion->name }}</div>
                <div>{{ $promotion->city->city_name }}</div>
                <a href="{{ route('promotion.edit', [ $promotion->id ]) }}">Редактировать</a>
                <x-form method="delete" :action="route('promotion.destroy', [ $promotion->id ])">
                    <button class="btn btn-danger">Удалить акцию</button>
                </x-form>
            </div>
        @endforeach
    </div>
</x-layout.admin>
