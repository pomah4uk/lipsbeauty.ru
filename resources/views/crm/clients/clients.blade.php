@extends('components.admin-layout')
@section('content')
<div class="admin__content">
    <h2 class="mb-3">Клиенты</h2>
    @include('crm.clients.client-cards', ['clients' => $clients])
</div>
@endsection