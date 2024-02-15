<x-layout.admin title="Редактировать: {{$promotion->name}}">
    <x-form action="{{ route('promotion.update', [ $promotion->id ]) }}" method="patch">
        @bind($promotion)
        @include('admin.promotion.base_form')
        <div class="mb-3">
            <x-form-input type="checkbox" name="is_active" :checked="$promotion->is_active" label="Акция активна после публикации?" />
        </div>
        <div class="mb-3">
            <x-form-input name="link" label='Ссылка на внешний ресурс вида "https://ссылка"' />
        </div>
        @endbind
        <div class="mb-3">
            <button class="btn btn-success">Обновить</button>
        </div>
    </x-form>
    <h3>Обновить изображение акции</h3>
    <x-form action="{{ route('image.store') }}" enctype="multipart/form-data" method="post">
        <input type="hidden" name="id" value="{{$promotion->id }}">
        <input type="hidden" name="model" value="promotion">
        <x-form-input type="file" name="image" label="Новое изображение" />
        <div class="mb-3">
            <button class="btn btn-success">Обновить изображение</button>
        </div>
    </x-form>
</x-layout.admin>
