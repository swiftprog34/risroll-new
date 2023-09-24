<x-layout.admin title="Добавить зону доставки">
    <x-form action="{{ route('zone.store') }}">
        <div class="mb-3">
            <x-form-input name="name" label="Наименование зоны доставки" />
        </div>
        <div class="mb-3">
            <x-form-input name="min_delivery_price" label="Бесплатная доставка от" />
        </div>
        <div class="mb-3">
            <x-form-select name="city_id" label="В каком городе" :options="$cities"  :size="$cities->count()" placeholder="Не выбран" />
        </div>
        <div class="mb-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </x-form>
</x-layout.admin>
