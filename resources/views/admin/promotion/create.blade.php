<x-layout.admin title="Добавить Акцию">
    <x-form action="{{ route('promotion.store') }}">
        @include('admin.promotion.base_form')
        <div class="mb-3">
            <x-form-input type="checkbox" name="is_active" label="Акция активна после публикации?" />
        </div>
        <div class="mb-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </x-form>
</x-layout.admin>
