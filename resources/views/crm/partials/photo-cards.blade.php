<div class="crm-cards-list">
    @foreach($photos as $photo)
        <div class="crm-card">
            <img src="{{ $photo->name_photo }}" alt="" class="crm-card__img">
            <div class="crm-card__row"><span class="crm-card__label">Описание</span><span class="crm-card__value">{{ $photo->description }}</span></div>
            <div class="crm-card__row"><span class="crm-card__label">Оригинальное имя</span><span class="crm-card__value">{{ $photo->original_name }}</span></div>
            <div class="crm-card__row"><span class="crm-card__label">Дата загрузки</span><span class="crm-card__value">{{ $photo->created_at->format('d.m.Y H:i') }}</span></div>
            <div class="crm-card__actions">
                <a href="{{ route('crm.photos.edit', $photo) }}" class="admin__btn admin__btn--small">Редактировать</a>
                <form action="{{ route('crm.photos.destroy', $photo) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin__btn admin__btn--danger admin__btn--small" onclick="return confirm('Удалить фото?')">Удалить</button>
                </form>
            </div>
        </div>
    @endforeach
</div> 