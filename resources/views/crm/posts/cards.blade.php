@php
    use Illuminate\Support\Str;
@endphp

<div class="crm-cards-list">
    @foreach($posts as $post)
        <div class="crm-card">
            <div class="crm-card__row">
                <span class="crm-card__label">Картинка</span>
                <span class="crm-card__value">
                    <img src="{{ $post->img_path }}" alt="" class="crm-card__img">
                </span>
            </div>
            <div class="crm-card__row">
                <span class="crm-card__label">ID</span>
                <span class="crm-card__value">{{ $post->id }}</span>
            </div>
            <div class="crm-card__row">
                <span class="crm-card__label">Название</span>
                <span class="crm-card__value">{{ $post->title }}</span>
            </div>
            <div class="crm-card__row">
                <span class="crm-card__label">Описание</span>
                <span class="crm-card__value">
                    {{ Str::limit(strip_tags($post->content), 150) }}
                    @if(strlen(strip_tags($post->content)) > 150)
                        ...
                    @endif
                </span>
            </div>
            <div class="crm-card__actions">
                <a href="{{ route('crm.posts.edit', $post) }}" class="admin__btn admin__btn--small">Редактировать</a>
                <form action="{{ route('crm.posts.destroy', $post) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin__btn admin__btn--danger admin__btn--small" onclick="return confirm('Удалить пост?')">Удалить</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
