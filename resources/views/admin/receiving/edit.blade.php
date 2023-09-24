<x-layout.admin title="Редактировать способ получения товара: {{ $receiving->receiving_variant->text() }}">
    <x-form action="{{ route('receiving.update', [ $receiving->id ]) }}" method="patch">
        @bind($receiving)
        <div class="mb-3">
            <x-form-select name="delivery_zone_id" label="Зона доставки" :options="$zones"  :size="$zones->count()" placeholder="Не выбрана" />
        </div>
        <div class="mb-3">
            <x-form-select name="receiving_variant" :default="$receiving->receiving_variant->value" label="Вариант получения" :options="$receiving_variants"  :size="$receiving_variants->count()" placeholder="Не выбран" />
        </div>
        @endbind
        <div class="mb-3">
            <button class="btn btn-success">Обновить</button>
        </div>
    </x-form>
</x-layout.admin>
