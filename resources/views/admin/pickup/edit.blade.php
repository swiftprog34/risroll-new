<x-layout.admin title="Редактировать: {{$pickup->name}}">
    <x-form action="{{ route('pickup.update', [ $pickup->id ]) }}" method="patch">
        @bind($pickup)
        <div class="mb-3">
            <x-form-input name="name" label="Наименование точки (адрес)" />
        </div>
        <div class="mb-3">
            <x-form-select name="city_id" label="В каком городе" :options="$cities"  :size="$cities->count()" placeholder="Не выбран" />
        </div>
        <div class="mb-3">
            <button class="btn btn-success">Обновить</button>
        </div>
        @endbind
    </x-form>
</x-layout.admin>
