@extends('components.admin-layout')
@section('content')
<div class="admin__content">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Услуги</h2>
        <a href="{{ route('crm.services.create') }}" class="admin__btn">Добавить услугу</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @include('crm.services.cards', ['services' => $services])
    <div>
        {{ $services->links() }}
    </div>
</div>
@endsection 