<x-layout.admin title="Все менеджеры">
    <a href="{{ route('manager.create') }}">Добавить менеджера</a> |
    <hr>
    <div class="row">
        @foreach($managers as $manager)
            <div class="col m-3">
                <div>{{ $manager->name }}</div>
                <div>{{ $manager->email }}</div>
                <a href="{{ route('manager.edit', [ $manager->id ]) }}">Изменить пароль</a>
                <x-form method="delete" :action="route('manager.destroy', [ $manager->id ])">
                    <button class="btn btn-danger">Удалить менеджера</button>
                </x-form>
            </div>
        @endforeach
    </div>
</x-layout.admin>
