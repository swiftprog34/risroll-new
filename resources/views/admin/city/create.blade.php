<x-layout.admin title="Добавить город">
    <x-form action="{{ route('city.store') }}">
        @include('admin.city.base_form')
        <div class="mb-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </x-form>
</x-layout.admin>
