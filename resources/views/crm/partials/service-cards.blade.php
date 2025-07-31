<div class="crm-cards-list">
    @foreach($services as $service)
        <div class="crm-card">
            <div class="crm-card__row"><span class="crm-card__label">ID</span><span class="crm-card__value">{{ $service->id }}</span></div>
            <div class="crm-card__row"><span class="crm-card__label">Название</span><span class="crm-card__value">{{ $service->title }}</span></div>
            <div class="crm-card__row"><span class="crm-card__label">Описание</span><span class="crm-card__value">{{ $service->description }}</span></div>
            <div class="crm-card__row"><span class="crm-card__label">Картинка</span><span class="crm-card__value"><img src="{{ $service->image }}" alt="" class="crm-card__img"></span></div>
            <div class="crm-card__actions">
                <a href="{{ route('crm.services.edit', $service) }}" class="admin__btn admin__btn--small">Редактировать</a>
                <form action="{{ route('crm.services.destroy', $service) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin__btn admin__btn--danger admin__btn--small" onclick="return confirm('Удалить услугу?')">Удалить</button>
                </form>
            </div>
        </div>
    @endforeach
</div> 