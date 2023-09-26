<x-layout.admin title="Все категории">
    <hr>
    <div class="row">
        @foreach($categories as $category)
            <div class="col m-3">
                <div>{{ $category->title }}</div>
                <div>{{ $category->city->city_name }}</div>
                <div>Видимость на сайте: {{ $category->is_active }}</div>
                <a href="{{ route('category.edit', [ $category->id ]) }}">Редактировать</a>
            </div>
        @endforeach
    </div>
</x-layout.admin>
