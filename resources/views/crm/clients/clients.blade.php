@extends('components.admin-layout')

@section('page-title', 'Управление клиентами')

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
                <i class="fa fa-users"></i>
            </div>
            <div class="crm__stats-content">
                <h3 class="crm__stats-number">{{ $clients->count() }}</h3>
                <p class="crm__stats-label">Всего клиентов</p>
            </div>
        </div>
        
        <div class="crm__stats-card">
            <div class="crm__stats-icon">
                <i class="fa fa-calendar"></i>
            </div>
            <div class="crm__stats-content">
                <h3 class="crm__stats-number">{{ $clients->where('created_at', '>=', now()->subDays(30))->count() }}</h3>
                <p class="crm__stats-label">За последний месяц</p>
            </div>
        </div>
    </div>

    @if($clients->count() > 0)
        <div class="crm__cards">
            @foreach($clients as $client)
                <div class="crm__card">
                    <div class="crm__card-header">
                        <h3 class="crm__card-title">
                            <i class="fa fa-user"></i>
                            {{ $client->name }}
                        </h3>
                    </div>
                    
                    <div class="crm__card-content">
                        <div class="crm__card-field">
                            <span class="crm__card-label">Телефон:</span>
                            <span class="crm__card-value">
                                <a href="tel:{{ $client->phone }}" class="crm__card-link">
                                    <i class="fa fa-phone"></i>
                                    {{ $client->phone }}
                                </a>
                            </span>
                        </div>
                        
                        @if($client->email)
                            <div class="crm__card-field">
                                <span class="crm__card-label">Email:</span>
                                <span class="crm__card-value">
                                    <a href="mailto:{{ $client->email }}" class="crm__card-link">
                                        <i class="fa fa-envelope"></i>
                                        {{ $client->email }}
                                    </a>
                                </span>
                            </div>
                        @endif
                        
                        @if($client->comment)
                            <div class="crm__card-field">
                                <span class="crm__card-label">Комментарий:</span>
                                <span class="crm__card-value">{{ $client->comment }}</span>
                            </div>
                        @endif
                        
                        <div class="crm__card-field">
                            <span class="crm__card-label">Дата регистрации:</span>
                            <span class="crm__card-value">
                                <i class="fa fa-calendar"></i>
                                {{ $client->created_at->format('d.m.Y H:i') }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="crm__empty">
            <div class="crm__empty-icon">
                <i class="fa fa-users"></i>
            </div>
            <h3 class="crm__empty-title">Клиенты не найдены</h3>
            <p class="crm__empty-text">У вас пока нет клиентов. Добавьте первого клиента, чтобы начать работу.</p>
        </div>
    @endif
@endsection

@push('scripts')
<style>
    .crm__stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .crm__stats-card {
        background: #fff;
        border-radius: 0.75rem;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .crm__stats-icon {
        width: 3rem;
        height: 3rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.25rem;
    }

    .crm__stats-content {
        flex: 1;
    }

    .crm__stats-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 0.25rem 0;
    }

    .crm__stats-label {
        color: #64748b;
        font-size: 0.875rem;
        margin: 0;
    }

    .crm__card-link {
        color: #3b82f6;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        transition: color 0.2s ease;
    }

    .crm__card-link:hover {
        color: #2563eb;
        text-decoration: underline;
    }

    .crm__empty {
        text-align: center;
        padding: 4rem 2rem;
        background: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
    }

    .crm__empty-icon {
        width: 4rem;
        height: 4rem;
        background: #f1f5f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: #64748b;
        font-size: 1.5rem;
    }

    .crm__empty-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 0.5rem 0;
    }

    .crm__empty-text {
        color: #64748b;
        margin: 0 0 2rem 0;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    @media (max-width: 768px) {
        .crm__stats {
            grid-template-columns: 1fr;
        }
        
        .crm__stats-card {
            padding: 1rem;
        }
        
        .crm__empty {
            padding: 2rem 1rem;
        }
    }
</style>
@endpush