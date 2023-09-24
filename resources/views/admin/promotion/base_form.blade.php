<div class="mb-3">
    <x-form-input name="name" label="Заголовок акции" />
</div>
<div class="mb-3">
    <x-form-textarea name="description" label="Описание акции (Необязательно)" />
</div>
<div class="mb-3">
    <x-form-input type="date" name="expiration_date" label="Дата окончания акции (Начиная с этой даты, акция не будет отображаться)" />
</div>
<div class="mb-3">
    <x-form-select name="city_id" label="В каком городе" :options="$cities"  :size="$cities->count()" placeholder="Не выбран" />
</div>
