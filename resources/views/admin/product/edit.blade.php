<x-layout.admin title="Редактировать изображение: {{$product->title}}">
    <x-form action="{{ route('image.store') }}" method="post">
        <input type="hidden" name="id" value="{{$product->id }}">
        <input type="hidden" name="model" value="product">
        <x-form-input type="file" name="path" label="Новое изображение" />
        <div class="mb-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </x-form>
</x-layout.admin>
