<x-layout.admin title="Все способы получения товара">
    <a href="{{ route('receiving.create') }}">Добавить способ получения товаров</a> |
    <hr>

    <div class="row">
        @foreach($receivings as $receiving)
            <div class="col m-3">
                <div>Зона доставки: {{ $receiving->zone->name }}</div>
                <div>Способ получения товара: {{ $receiving->receiving_variant->text() }}</div>
                <a href="{{ route('receiving.edit', [ $receiving->id ]) }}">Редактировать способ получения товаров</a>
                <x-form method="delete" :action="route('receiving.destroy', [ $receiving->id ])">
                    <button class="btn btn-danger">Удалить способ получения товаров</button>
                </x-form>
            </div>
        @endforeach
    </div>
</x-layout.admin>
