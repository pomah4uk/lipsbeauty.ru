<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client as HttpClient;
use App\Models\Service;

class ClientController extends Controller
{
    // Отображение клиентов в CRM
    public function index()
    {
        $clients = Client::orderByDesc('created_at')->paginate(20);
        return view('/crm/clients', compact('clients'));
    }

    // Приём формы с сайта
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:32',
        ]);
        $client = Client::create($data);
        // Отправка в Telegram
        try {
            $this->sendToTelegram($client);
            Log::info('Успешно');
        } catch (\Exception $e) {
            Log::error('Ошибка отправки в Telegram: ' . $e->getMessage());
        }
        return back()->with('success', 'Спасибо! Ваша заявка отправлена.');
    }

    // Отправка данных в Telegram
    protected function sendToTelegram($lead)
    {
        $token = env('TELEGRAM_BOT_TOKEN');
        $chat_id = env('TELEGRAM_CHAT_ID');
    
        if (!$token || !$chat_id) {
            Log::warning('Отсутствует TELEGRAM_BOT_TOKEN или TELEGRAM_CHAT_ID');
            return;
        }
    
        $text = "Новая заявка с сайта:\n" .
            "Имя: {$lead->name}\n" .
            ($lead->phone ? "Телефон: {$lead->phone}\n" : "") .
            "Дата: {$lead->created_at->format('d.m.Y H:i')}";
    
        $url = "https://api.telegram.org/bot{$token}/sendMessage";
    
        try {
            $http = new \GuzzleHttp\Client();
            $response = $http->post($url, [
                'form_params' => [
                    'chat_id' => $chat_id,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                ],
                // ❗️ В бою — включи проверку сертификата:
                // 'verify' => true (по умолчанию)
            ]);
    
            $body = json_decode($response->getBody(), true);
    
            if (!($body['ok'] ?? false)) {
                Log::error('Ошибка Telegram API: ' . json_encode($body));
            }
    
        } catch (\Exception $e) {
            Log::error('Telegram Exception: ' . $e->getMessage());
        }
    }
}
