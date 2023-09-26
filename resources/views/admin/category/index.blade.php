<x-layout.admin title="Все категории">
    <hr>
    <div class="row">
        @foreach($categories as $category)
            <div class="col m-3">
                <div><a href="{{ route('category.edit', [ $category->id ]) }}">{{ $category->title }}</a></div>
                <div>{{ $category->city->city_name }}</div>
                <div>Видимость на сайте: {{ $category->is_active }}</div>
                @foreach($category->products as $product)
                    <div><a href="{{ route('product.edit', [ $product->id ]) }}">{{ $product->title }}</a></div>
                    <div>{{ $product->sku}}</div>
                    <div>{{ $product->price}}</div>
                @endforeach
            </div>
        @endforeach
    </div>
</x-layout.admin>
