<x-layout.admin title="Редактировать товар: {{$product->title}}">
    <x-form action="{{ route('product.update', [ $product->id ]) }}" method="patch">
        @bind($product)
        <div class="mb-3">
            <x-form-input name="title" label="Название" />
        </div>
        <div class="mb-3">
            <x-form-textarea name="description" label="Описание" />
        </div>
        <div class="mb-3">
            <x-form-input type="number" name="weight" label="Вес в граммах" />
        </div>
        <div class="mb-3">
            <x-form-input type="number" name="price" label="Цена (рекомендуется обновлять из Мобидел!)" />
        </div>
        <div class="mb-3">
            <input type="hidden" name="is_active" value="0" />
            <x-form-checkbox name="is_active" label="Товар доступен на сайте" />
        </div>
        <div class="mb-3">
            <input type="hidden" name="is_new_item" value="0" />
            <x-form-checkbox name="is_new_item" label="Размещать в разделе 'Новинки'" />
        </div>
        @endbind
        <div class="mb-3">
            <button class="btn btn-success">Обновить информацию о товаре</button>
        </div>
    </x-form>

    <x-form action="{{ route('image.store') }}" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="{{$product->id }}">
        <input type="hidden" name="model" value="product">
        <x-form-input type="file" name="image" label="Новое изображение" />
        <div class="mb-3">
            <button class="btn btn-success">Сохранить изображение</button>
        </div>
    </x-form>
</x-layout.admin>
