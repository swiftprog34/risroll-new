<x-layout.admin title="Редактировать параметры: {{$category->title}}">
    <x-form action="{{ route('category.update', [ $category->id ]) }}" method="patch">
        @bind($category)
        <div class="mb-3">
            <x-form-input name="title" label="Название" />
        </div>
        <div class="mb-3">
            <x-form-textarea name="description" label="Информация на странице категории" />
        </div>
        <div class="mb-3">
            <input type="hidden" name="is_active" value="0" />
            <x-form-checkbox name="is_active" label="Категория доступна на сайте" />
        </div>
        @endbind
        <div class="mb-3">
            <button class="btn btn-success">Обновить</button>
        </div>
    </x-form>
    <hr>
    <h3>Обновить изображение категории</h3>
    <x-form action="{{ route('image.store') }}" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="{{$category->id }}">
        <input type="hidden" name="model" value="category">
        <x-form-input type="file" name="image" label="Новое изображение" />
        <div class="mb-3">
            <button class="btn btn-success">Обновить изображение</button>
        </div>
    </x-form>
</x-layout.admin>
