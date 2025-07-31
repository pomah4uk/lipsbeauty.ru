<div class="crm-cards-list">
    @foreach($clients as $client)
        <div class="crm-card">
            <div class="crm-card__row"><span class="crm-card__label">ID</span><span class="crm-card__value">{{ $client->id }}</span></div>
            <div class="crm-card__row"><span class="crm-card__label">Имя</span><span class="crm-card__value">{{ $client->name }}</span></div>
            <div class="crm-card__row"><span class="crm-card__label">Телефон</span><span class="crm-card__value">{{ $client->phone }}</span></div>
            <div class="crm-card__row"><span class="crm-card__label">Дата</span><span class="crm-card__value">{{ $client->created_at->format('d.m.Y H:i') }}</span></div>
        </div>
    @endforeach
</div> 