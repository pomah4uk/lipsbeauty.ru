@extends('components.admin-layout')
@section('content')
<div class='admin__content'>
    <div class='d-flex justify-content-between align-items-center mb-3'>
        <h2>Посты</h2>
        <a href="{{ route('crm.posts.create') }}" class="admin__btn">Добавить пост</a>
    </div>
    @include('crm.posts.cards', ['posts' => $posts])
    <div>
        {{ $posts->links() }}
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
</div>
@endsection