<x-layout.admin title="Редактировать: {{$zone->name}}">
    <x-form action="{{ route('zone.update', [ $zone->id ]) }}" method="patch">
        @bind($zone)
        <div class="mb-3">
            <x-form-input type="text" name="name" label="Наименование зоны доставки" />
        </div>
        <div class="mb-3">
            <x-form-input name="min_delivery_price" label="Бесплатная доставка от" />
        </div>
        <div class="mb-3">
            <x-form-select name="city_id" label="В каком городе" :options="$cities"  :size="$cities->count()" placeholder="Не выбран" />
        </div>
        <div class="mb-3">
            <x-form-textarea name="indicies" :default="$indices" label="Индексы" />
        </div>
        @endbind

        <div class="mb-3">
            <button class="btn btn-success">Обновить</button>
        </div>

    </x-form>

    <h3>Способы получения товаров</h3>
    @foreach($receivings as $receiving)
        <div class="col m-3">
            <div>Способ получения товара: {{ $receiving->receiving_variant->text() }}</div>
            <a href="{{ route('receiving.edit', [ $receiving->id ]) }}">Редактировать способ получения товаров</a>
            <x-form method="delete" :action="route('receiving.destroy', [ $receiving->id ])">
                <button class="btn btn-danger">Удалить способ получения товаров</button>
            </x-form>
        </div>
    @endforeach
    <hr>
    <a href="{{ route('receiving.create') }}">Добавить способ получения товаров</a> |
    <hr>
</x-layout.admin>
