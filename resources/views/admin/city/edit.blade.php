<x-layout.admin title="Редактировать параметры: {{$city->city_name}}">
    <x-form action="{{ route('city.update', [ $city->id ]) }}" method="patch">
        @bind($city)
        @include('admin.city.base_form')
        <div class="mb-3">
            <x-form-input name="vk_link" label="Ссылка на группу ВК (Необязательно)" />
        </div>
        <div class="mb-3">
            <x-form-input name="instagram_link" label="Ссылка на группу Инстаграм (Необязательно)" />
        </div>
        <div class="mb-3">
            <x-form-textarea name="contact_page_info" label="Информация на странице 'Контакты' (Необязательно)" />
        </div>
        <div class="mb-3">
            <x-form-input name="contact_map" label="Iframe ссылка Yandex на карту всех пунктов самовывоза (Необязательно)" />
        </div>
        <div class="mb-3">
            <x-form-textarea name="delivery_page_info" label="Информация на странице 'Доставка' (Необязательно)" />
        </div>
        <div class="mb-3">
            <x-form-input name="delivery_map" label="Iframe ссылка Yandex на карту зоны доставок (Необязательно)" />
        </div>
        <div class="mb-3">
            <x-form-textarea name="promotions_page_info" label="Информация на странице 'Акции' (Необязательно)" />
        </div>
        <div class="mb-3">
            <input type="hidden" name="can_make_orders" value="0" />
            <x-form-checkbox name="can_make_orders" label="Разрешено формировать заказы" />
        </div>
        @endbind
        <div class="mb-3">
            <button class="btn btn-success">Обновить</button>
        </div>
    </x-form>
</x-layout.admin>
