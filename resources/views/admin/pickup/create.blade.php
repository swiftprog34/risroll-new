<x-layout.admin title="Добавить точку самовывоза">
    <x-form action="{{ route('pickup.store') }}">
        <div class="mb-3">
            <x-form-input name="name" label="Наименование точки (адрес)" />
        </div>
        <div class="mb-3">
            <x-form-select name="city_id" label="В каком городе" :options="$cities"  :size="$cities->count()" placeholder="Не выбран" />
        </div>
        <div class="mb-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </x-form>
</x-layout.admin>
