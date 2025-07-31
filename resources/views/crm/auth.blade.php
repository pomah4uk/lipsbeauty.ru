@extends('components.admin-layout')
@section('content')
<div class="admin__content" style="max-width:400px;margin:40px auto;">
    <h2 class="mb-3">Вход в CRM</h2>
    <form method="POST" action="{{ route('crm.login.post') }}">
        @csrf
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" name="login" value="{{ old('login') }}" required autofocus>
            @error('login')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @if($errors->has('login'))
            <div class="alert alert-danger mb-3">{{ $errors->first('login') }}</div>
        @endif
        <button type="submit" class="admin__btn">Войти</button>
    </form>
</div>
@endsection 