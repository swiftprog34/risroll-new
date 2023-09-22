<x-layout.main title="Добавить город">
    <x-form action="{{ route('city.store') }}">
        <div class="mb-3">
            <x-form-input name="slug" label="Домен" />
        </div>
        <div class="mb-3">
            <x-form-input name="city_name" label="Город" />
        </div>
        <div class="mb-3">
            <x-form-input name="email" label="Email" />
        </div>
        <div class="mb-3">
            <x-form-input name="phone" label="Телефон" />
        </div>
        <div class="mb-3">
            <x-form-input name="w_id" label="Идентификатор предприятия (Мобидел)" />
        </div>
        <div class="mb-3">
            <x-form-input name="restaurant_id" label="UID службы доставки (Мобидел)" />
        </div>
        <div class="mb-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </x-form>
</x-layout.main>
