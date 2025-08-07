<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class AdminController extends Controller
{
    public function clients(){
        return view('crm.clients.clients', ['clients'=>Client::orderByDesc('created_at')->paginate(20)]);
    }
}
