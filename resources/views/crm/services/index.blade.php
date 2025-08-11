@extends('components.admin-layout')

@section('page-title', 'Управление услугами')

@section('header-actions')
    <a href="{{ route('crm.services.create') }}" class="crm__btn crm__btn--primary">
        <i class="fa fa-plus"></i>
        Добавить услугу
    </a>
@endsection

@section('content')
    @if(session('success'))
        <div class="crm__alert crm__alert--success">
            <i class="fa fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="crm__alert crm__alert--error">
            <i class="fa fa-exclamation-triangle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="crm__stats">
        <div class="crm__stats-card">
            <div class="crm__stats-icon">
                <i class="fa fa-cogs"></i>
            </div>
            <div class="crm__stats-content">
                <h3 class="crm__stats-number">{{ $services->count() }}</h3>
                <p class="crm__stats-label">Всего услуг</p>
            </div>
        </div>
        
        <div class="crm__stats-card">
            <div class="crm__stats-icon">
                <i class="fa fa-star"></i>
            </div>
            <div class="crm__stats-content">
                <h3 class="crm__stats-number">{{ $services->where('is_active', true)->count() }}</h3>
                <p class="crm__stats-label">Активных услуг</p>
            </div>
        </div>
    </div>

    @if($services->count() > 0)
        <div class="crm__cards">
            @foreach($services as $service)
                <div class="crm__card">
                    <div class="crm__card-header">
                        <h3 class="crm__card-title">
                            <i class="fa fa-cog"></i>
                            {{ $service->title }}
                        </h3>
                        <div class="crm__card-actions">
                            <a href="{{ route('crm.services.edit', $service->id) }}" 
                               class="crm__btn crm__btn--small crm__btn--secondary"
                               title="Редактировать">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('crm.services.destroy', $service->id) }}" 
                                  method="POST" 
                                  style="display: inline;"
                                  onsubmit="return confirm('Вы уверены, что хотите удалить эту услугу?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="crm__btn crm__btn--small crm__btn--danger"
                                        title="Удалить">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" 
                             alt="{{ $service->title }}" 
                             class="crm__card-image">
                    @endif
                    
                    <div class="crm__card-content">
                        @if($service->description)
                            <div class="crm__card-field">
                                <span class="crm__card-label">Описание:</span>
                                <span class="crm__card-value">{{ Str::limit($service->description, 100) }}</span>
                            </div>
                        @endif
                        
                        @if($service->price)
                            <div class="crm__card-field">
                                <span class="crm__card-label">Цена:</span>
                                <span class="crm__card-value">
                                    <i class="fa fa-rub"></i>
                                    {{ number_format($service->price, 0, ',', ' ') }} ₽
                                </span>
                            </div>
                        @endif
                        
                        <div class="crm__card-field">
                            <span class="crm__card-label">Статус:</span>
                            <span class="crm__card-value">
                                @if($service->is_active)
                                    <span class="crm__status crm__status--active">
                                        <i class="fa fa-check-circle"></i>
                                        Активна
                                    </span>
                                @else
                                    <span class="crm__status crm__status--inactive">
                                        <i class="fa fa-times-circle"></i>
                                        Неактивна
                                    </span>
                                @endif
                            </span>
                        </div>
                        
                        <div class="crm__card-field">
                            <span class="crm__card-label">Дата создания:</span>
                            <span class="crm__card-value">
                                <i class="fa fa-calendar"></i>
                                {{ $service->created_at->format('d.m.Y H:i') }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($services->hasPages())
            <div class="crm__pagination">
                {{ $services->links() }}
            </div>
        @endif
    @else
        <div class="crm__empty">
            <div class="crm__empty-icon">
                <i class="fa fa-cogs"></i>
            </div>
            <h3 class="crm__empty-title">Услуги не найдены</h3>
            <p class="crm__empty-text">У вас пока нет услуг. Добавьте первую услугу, чтобы начать работу.</p>
            <a href="{{ route('crm.services.create') }}" class="crm__btn crm__btn--primary">
                <i class="fa fa-plus"></i>
                Добавить услугу
            </a>
        </div>
    @endif
@endsection

@push('scripts')
<style>
    .crm__status {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .crm__status--active {
        background-color: #d1fae5;
        color: #065f46;
    }

    .crm__status--inactive {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .crm__pagination {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .crm__pagination .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .crm__pagination .page-item {
        margin: 0;
    }

    .crm__pagination .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s ease;
        background: #fff;
    }

    .crm__pagination .page-link:hover {
        background-color: #f8fafc;
        color: #374151;
        border-color: #cbd5e1;
    }

    .crm__pagination .page-item.active .page-link {
        background-color: #3b82f6;
        color: #fff;
        border-color: #3b82f6;
    }

    .crm__pagination .page-item.disabled .page-link {
        background-color: #f1f5f9;
        color: #94a3b8;
        cursor: not-allowed;
    }
</style>
@endpush 