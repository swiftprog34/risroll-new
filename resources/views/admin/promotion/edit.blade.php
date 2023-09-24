<x-layout.admin title="Редактировать: {{$promotion->name}}">
    <x-form action="{{ route('promotion.update', [ $promotion->id ]) }}" method="patch">
        @bind($promotion)
        @include('admin.promotion.base_form')
        <div class="mb-3">
            <x-form-input type="checkbox" name="is_active" :checked="$promotion->is_active" label="Акция активна после публикации?" />
        </div>
        @endbind
        <div class="mb-3">
            <button class="btn btn-success">Обновить</button>
        </div>
    </x-form>
</x-layout.admin>
