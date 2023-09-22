<x-layout.admin title="Добавить менеджера">
    <x-form action="{{ route('manager.store') }}">
        <div class="mb-3">
            <x-form-input name="name" label="Имя (специализация) менеджера" />
        </div>
        <div class="mb-3">
            <x-form-input name="email" label="Email" />
        </div>
        <div class="mb-3">
            <x-form-input type="password" name="password" label="Пароль" />
        </div>
        <div class="mb-3">
            <x-form-input type="password" name="password_confirmation" label="Подтверждение пароля" />
        </div>
        <div class="mb-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </x-form>
</x-layout.admin>
