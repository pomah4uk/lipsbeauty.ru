<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в CRM</title>
    <link rel="stylesheet" href="{{ asset('css/crm/crm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/public/font-awesome.min.css') }}">
</head>
<body>
    <div class="crm-auth">
        <div class="crm-auth__container">
            <div class="crm-auth__card">
                <div class="crm-auth__header">
                    <h1 class="crm-auth__title">
                        <i class="fa fa-lock"></i>
                        Вход в CRM
                    </h1>
                    <p class="crm-auth__subtitle">Введите ваши учетные данные для доступа к панели администратора</p>
                </div>

                @if($errors->any())
                    <div class="crm__alert crm__alert--error">
                        <i class="fa fa-exclamation-triangle"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('crm.login.post') }}" class="crm-auth__form">
                    @csrf
                    
                    <div class="crm__form-group">
                        <label for="login" class="crm__form-label">
                            <i class="fa fa-user"></i>
                            Логин
                        </label>
                        <input 
                            type="text" 
                            class="crm__form-input" 
                            id="login" 
                            name="login" 
                            value="{{ old('login') }}" 
                            required 
                            autofocus
                            placeholder="Введите логин"
                        >
                        @error('login')
                            <div class="crm__form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="crm__form-group">
                        <label for="password" class="crm__form-label">
                            <i class="fa fa-key"></i>
                            Пароль
                        </label>
                        <div class="crm-auth__password-wrapper">
                            <input 
                                type="password" 
                                class="crm__form-input" 
                                id="password" 
                                name="password" 
                                required
                                placeholder="Введите пароль"
                            >
                            <button 
                                type="button" 
                                class="crm-auth__password-toggle" 
                                id="togglePassword"
                                aria-label="Показать/скрыть пароль"
                            >
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="crm__form-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="crm__btn crm__btn--primary crm-auth__submit">
                        <i class="fa fa-sign-in"></i>
                        Войти в систему
                    </button>
                </form>

                <div class="crm-auth__footer">
                    <a href="{{ route('home') }}" class="crm-auth__link">
                        <i class="fa fa-arrow-left"></i>
                        Вернуться на главную
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .crm-auth {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .crm-auth__container {
            width: 100%;
            max-width: 400px;
        }

        .crm-auth__card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            text-align: center;
        }

        .crm-auth__header {
            margin-bottom: 2rem;
        }

        .crm-auth__title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 0.5rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .crm-auth__subtitle {
            color: #64748b;
            margin: 0;
            font-size: 0.875rem;
        }

        .crm-auth__form {
            text-align: left;
        }

        .crm-auth__password-wrapper {
            position: relative;
        }

        .crm-auth__password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.2s ease;
        }

        .crm-auth__password-toggle:hover {
            background-color: #f1f5f9;
            color: #374151;
        }

        .crm-auth__submit {
            width: 100%;
            margin-top: 1rem;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
        }

        .crm-auth__footer {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .crm-auth__link {
            color: #64748b;
            text-decoration: none;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.2s ease;
        }

        .crm-auth__link:hover {
            color: #3b82f6;
        }

        @media (max-width: 480px) {
            .crm-auth {
                padding: 1rem;
            }

            .crm-auth__card {
                padding: 2rem 1.5rem;
            }

            .crm-auth__title {
                font-size: 1.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const icon = togglePassword.querySelector('i');

            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                if (type === 'password') {
                    icon.className = 'fa fa-eye';
                } else {
                    icon.className = 'fa fa-eye-slash';
                }
            });
        });
    </script>
</body>
</html>