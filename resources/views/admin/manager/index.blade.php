<x-layout.admin title="Все пользователи">
    <a href="{{ route('manager.create') }}">Добавить менеджера</a> |
    <hr>
    <div class="row">
            <table class="table caption-top">
                <thead>
                <tr>
                    <th scope="col">Имя</th>
                    <th scope="col">Email</th>
                    <th scope="col">Роль на сайте</th>
                    <th scope="col">Закреплен за городом</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($managers as $manager)
                    <tr data-id="{{$manager->id}}">
                        <td>{{ $manager->name }}</td>
                        <td>{{ $manager->email }}</td>
                        <td>{{ $manager->role->text() }}</td>
                        <td>
                            @foreach($manager->cities as $city)
                                <div>{{$city->city_name}}</div>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('manager.edit', [ $manager->id ]) }}">Изменить пароль</a>
                        </td>
                        <td>
                            <x-form method="delete" :action="route('manager.destroy', [ $manager->id ])">
                                <button class="btn btn-danger">Удалить менеджера</button>
                            </x-form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
</x-layout.admin>
