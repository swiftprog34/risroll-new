<x-layout.admin title="Редактировать: {{$zone->name}}">
    <x-form action="{{ route('zone.update', [ $zone->id ]) }}" method="patch">
        @bind($zone)
        <div class="mb-3">
            <x-form-input name="name" label="Наименование зоны доставки" />
        </div>
        <div class="mb-3">
            <x-form-input name="min_delivery_price" label="Бесплатная доставка от" />
        </div>
        <div class="mb-3">
            <x-form-select name="city_id" label="В каком городе" :options="$cities"  :size="$cities->count()" placeholder="Не выбран" />
        </div>
        @endbind
        <div class="mb-3">
            <button class="btn btn-success">Обновить</button>
        </div>

    </x-form>
</x-layout.admin>
