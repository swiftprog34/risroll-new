<x-layout.admin title="Все категории">
    <hr>
    <div class="row">
        <h2 class="mt-5">Порядок сортировки категорий</h2>
        @foreach($citiesWithNested as $city)
            <table class="table caption-top">
                <h2>{{$city->city_name}}</h2>
                <thead>
                <tr>
                    <th scope="col">Категория</th>
                    <th scope="col">Видимость на сайте</th>
                    <th scope="col">Порядок сортировки</th>
                </tr>
                </thead>
                <tbody>
                @foreach($city->categories as $category)
                    <tr>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->is_active }}</td>
                        <td>{{$loop->iteration}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach

        <h2 class="mt-5">Каталог товаров</h2>
        @foreach($citiesWithNested as $city)
        <table class="table caption-top">
            <h3 class="mt-2">{{$city->city_name}}</h3>
            <thead>
                <tr>
                    <th scope="col">Категория</th>
                    <th scope="col">Видимость на сайте</th>
                </tr>
            </thead>
            <tbody>
            @foreach($city->categories as $category)
            <tr>
                <td><a href="{{ route('category.edit', [ $category->id ]) }}"><h5>{{ $category->title }}</h5></a></td>
                <td>{{ $category->is_active }}</td>
            </tr>
                <tr>
                    <td colspan="4">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Товар</th>
                                <th scope="col">Артикул</th>
                                <th scope="col">Цена в копейках</th>
                                <th scope="col">Видимость на сайте</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($category->products as $product)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td><a href="{{ route('product.edit', [ $product->id ]) }}">{{ $product->title }}</a></td>
                                <td>{{ $product->sku}}</td>
                                <td>{{ $product->price}}</td>
                                <td>{{ $product->is_active}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
</x-layout.admin>
