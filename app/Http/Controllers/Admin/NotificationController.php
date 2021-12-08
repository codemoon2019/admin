<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){

        return view('notification.notification');

    }

    public function notifList(Request $request){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->get(config('app.pure_api_url').'api/notification-list?page='.$request->get('page'));
        
        return $response;

    }

    public function notifHeaderList(Request $request){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->get(config('app.pure_api_url').'api/notification-header-list');
        
        return $response;

    }

}
