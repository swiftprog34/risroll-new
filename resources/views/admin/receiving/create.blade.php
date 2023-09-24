<x-layout.admin title="Добавить способ получения товара">
    <x-form action="{{ route('receiving.store') }}">
        <div class="mb-3">
            <x-form-select name="delivery_zone_id" label="Зона доставки" :options="$zones"  :size="$zones->count()" placeholder="Не выбрана" />
        </div>
        <div class="mb-3">
            <x-form-select name="receiving_variant" label="Вариант получения" :options="$receiving_variants"  :size="$receiving_variants->count()" placeholder="Не выбран" />
        </div>
        <div class="mb-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </x-form>
</x-layout.admin>
