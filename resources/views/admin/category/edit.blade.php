<x-layout.admin title="Редактировать параметры: {{$category->title}}">
    <x-form action="{{ route('category.update', [ $category->id ]) }}" method="patch">
        @bind($category)
        <div class="mb-3">
            <x-form-textarea name="description" label="Информация на странице категории" />
        </div>
        @endbind
        <div class="mb-3">
            <button class="btn btn-success">Обновить</button>
        </div>
    </x-form>
</x-layout.admin>
