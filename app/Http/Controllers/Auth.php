<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as LaravelAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class Auth extends Controller
{
    public function showLoginForm()
    {
        return view('crm.auth');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('login', $request->input('login'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            // Аутентифицируем пользователя
            LaravelAuth::login($user);
            Session::put('crm_auth', true);

            $this->sendLoginToTelegram($user);

            return redirect()->intended('/crm/clients');
        }

        return back()->withErrors(['login' => 'Неверный логин или пароль'])->withInput();
    }

    private function sendLoginToTelegram($user)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chat_id = env('TELEGRAM_CHAT_ID');
        if (!$token || !$chat_id) return;

        $text = "Вход в CRM:\nЛогин: {$user->login}\nIP: " . request()->ip() . "\nВремя: " . now()->format('d.m.Y H:i:s');
        $url = "https://api.telegram.org/bot{$token}/sendMessage";

        try {
            $http = new \GuzzleHttp\Client();
            $http->post($url, [
                'form_params' => [
                    'chat_id' => $chat_id,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                ],
            ]);
        } catch (\Exception $e) {
            // Не логируем ошибки
        }
    }

    public function logout()
    {
        LaravelAuth::logout();
        Session::forget('crm_auth');
        return redirect('/');
    }
}
