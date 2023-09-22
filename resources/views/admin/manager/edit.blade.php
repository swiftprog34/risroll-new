<x-layout.admin title="Обновить пароль менеджера: {{$manager->name}}">
    <x-form action="{{ route('manager.update', [ $manager->id ]) }}" method="patch">
        <div class="mb-3">
            <x-form-input type="password" name="password" label="Новый пароль" />
        </div>
        <div class="mb-3">
            <x-form-input type="password" name="password_confirmation" label="Подтверждение пароля" />
        </div>
        <div class="mb-3">
            <button class="btn btn-success">Обновить</button>
        </div>
    </x-form>
</x-layout.admin>
