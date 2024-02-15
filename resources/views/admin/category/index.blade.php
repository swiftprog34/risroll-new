<x-layout.admin title="Все категории">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <hr>
    <div class="row">
        <h2 class="mt-5">Порядок сортировки категорий</h2>
        @foreach($citiesWithNested as $city)
            <h3>{{$city->city_name}}</h3>
            <table class="table caption-top">

                <thead>
                <tr>
                    <th scope="col">Категория</th>
                    <th scope="col">Видимость на сайте</th>
                </tr>
                </thead>
                <tbody id="sortable-categories-{{$city->id}}">
                @foreach($city->categories as $category)
                    <tr data-id="{{$category->id}}">
                        <td>{{ $category->title }}</td>
                        <td>
                            @bind($category)
                            <x-form-checkbox name="is_active"/>
                            @endbind
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <script>
                    function updateToDatabaseCategory(idString) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });

                        $.ajax({
                            url: '{{ url("administrator/category/update-order") }}',
                            method: 'POST',
                            data: {
                                ids: idString
                            }
                        })
                    }


                    $('#sortable-categories-{{$city->id}}').sortable({
                        update: function() {
                            var sortData = $('#sortable-categories-{{$city->id}}').sortable('toArray', {
                                attribute: 'data-id'
                            })
                            updateToDatabaseCategory(sortData.join(','))
                        }
                    })
                </script>
            </table>
        @endforeach

        <h2 class="mt-5">Каталог товаров</h2>
        @foreach($citiesWithNested as $city)
        <h3 class="mt-2">{{$city->city_name}}</h3>
        <table class="table caption-top">
            <thead>
                <tr>
                    <th scope="col">Категория</th>
                </tr>
            </thead>
            <tbody>
            @foreach($city->categories as $category)
            <tr>
                <td><a href="{{ route('category.edit', [ $category->id ]) }}"><h5>{{ $category->title }}</h5></a></td>
            </tr>
                <tr>
                    <td colspan="4">
                        <table class="table mb-0">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Товар</th>
                                <th scope="col">Артикул</th>
                                <th scope="col">Цена</th>
                                <th scope="col">Видимость на сайте</th>
                            </tr>
                            </thead>
                            <tbody id="sortable-products-{{$category->id}}">
                            @foreach($category->products as $product)
                            <tr data-id="{{$product->id}}">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td><a href="{{ route('product.edit', [ $product->id ]) }}">{{ $product->title }}</a></td>
                                <td>{{ $product->sku}}</td>
                                <td>{{ $product->price}}</td>
                                <td>
                                    @bind($product)
                                    <x-form-checkbox name="is_active"/>
                                    @endbind
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <script>
                                function updateToDatabaseProduct(idString) {
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    });

                                    $.ajax({
                                        url: '{{ url("administrator/product/update-order") }}',
                                        method: 'POST',
                                        data: {
                                            ids: idString
                                        }
                                    })
                                }

                                $('#sortable-products-{{$category->id}}').sortable({
                                    update: function() {
                                        var sortData = $('#sortable-products-{{$category->id}}').sortable('toArray', {
                                            attribute: 'data-id'
                                        })
                                        updateToDatabaseProduct(sortData.join(','))
                                    }
                                })
                            </script>
                        </table>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
</x-layout.admin>
