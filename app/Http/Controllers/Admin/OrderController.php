<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\User;
use Response;

class OrderController extends Controller
{
    
    /**
    * Order History UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public function orderhistory(){
        return view('admin.order.history');
    }

    /**
    * New Orders UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public function neworder(){

        return view('admin.order.new');

    }

    public function newOrderListUser(Request $request){
        
        if(auth()->user()->user_type == 1){
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.config('app.pure_api_key'),
                'Content-Type' => 'application/json'
            ])->post(config('app.pure_api_url').'api/order-list', [
                "length" => $request->input('length'),
                "start" => $request->input('start'),
                "orderColumn" => $request->input('order.0.column'),
                "orderDirectory" => $request->input('order.0.dir'),
                "search" => $request->input('search.value'),
                "draw" => $request->input('draw')
            ]);
        }else{
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.config('app.pure_api_key'),
                'Content-Type' => 'application/json'
            ])->post(config('app.pure_api_url').'api/order-list-driver', [
                "length" => $request->input('length'),
                "start" => $request->input('start'),
                "orderColumn" => $request->input('order.0.column'),
                "orderDirectory" => $request->input('order.0.dir'),
                "search" => $request->input('search.value'),
                "draw" => $request->input('draw'),
                "driverID" => auth()->user()->id
            ]);
        }

        return $response;
    }

    public function newOrderListGuest(Request $request){
        
        if(auth()->user()->user_type == 1){
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.config('app.pure_api_key'),
                'Content-Type' => 'application/json'
            ])->post(config('app.pure_api_url').'api/guest-order-list', [
                "length" => $request->input('length'),
                "start" => $request->input('start'),
                "orderColumn" => $request->input('order.0.column'),
                "orderDirectory" => $request->input('order.0.dir'),
                "search" => $request->input('search.value'),
                "draw" => $request->input('draw')
            ]);
        }else{
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.config('app.pure_api_key'),
                'Content-Type' => 'application/json'
            ])->post(config('app.pure_api_url').'api/order-list-driver', [
                "length" => $request->input('length'),
                "start" => $request->input('start'),
                "orderColumn" => $request->input('order.0.column'),
                "orderDirectory" => $request->input('order.0.dir'),
                "search" => $request->input('search.value'),
                "draw" => $request->input('draw'),
                "driverID" => auth()->user()->id
            ]);
        }

        return $response;
    }

    public function orderDetails($id){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/order-details', [
            "order_id" => $id,
        ]);

        $paymentImageLink = 'no-path';
        
        $availableDriver = User::whereIn('user_type', [2])->get();

        $retrieveData = json_decode($response);
        $data = $retrieveData[0]->data;
        $total_price = $retrieveData[0]->total_price;

        if($retrieveData[0]->data[0]->order_payment_proof != null){
            $paymentImageLink = $retrieveData[0]->data[0]->order_payment_proof->proof_order_file;
        }else{
            $paymentImageLink = 'no-path';
        }

        return view('admin.order.order-details', compact('data', 'id', 'total_price', 'availableDriver', 'paymentImageLink'));

    }

    public function guestOrderDetails($id){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/guest-order-details', [
            "order_id" => $id,
        ]);

        $paymentImageLink = 'no-path';
        
        $availableDriver = User::whereIn('user_type', [2])->get();

        $retrieveData = json_decode($response);
        $data = $retrieveData[0]->data;
        $total_price = $retrieveData[0]->total_price;

        if($retrieveData[0]->data[0]->order_payment_proof != null){
            $paymentImageLink = $retrieveData[0]->data[0]->order_payment_proof->proof_order_file;
        }else{
            $paymentImageLink = 'no-path';
        }

        return view('admin.order.guest-order-details', compact('data', 'id', 'total_price', 'availableDriver', 'paymentImageLink'));

    }

    public function updateOrder(Request $request){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/update-order-status', [
            "status" => $request->status,
            "id" => $request->id,
        ]);
        
        $retrieveData = json_decode($response);
        
        return $retrieveData;

    }

    public function updateAllOrder(Request $request){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/update-all-order-status', [
            "status" => $request->status,
            "order_id" => $request->order_id,
        ]);
        
        $retrieveData = json_decode($response);
        
        return $retrieveData;

    }

    public function updateDriver(Request $request){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/update-driver', [
            "id" => $request->id,
            "order_id" => $request->order_id,
        ]);
        
        $retrieveData = json_decode($response);
        
        return $retrieveData;

    }


    public static function orderReceipt($id){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/order-details', [
            "order_id" => $id,
        ]);

        $paymentImageLink = 'no-path';
        
        $availableDriver = User::whereIn('user_type', [2])->get();

        $retrieveData = json_decode($response);
        $data = $retrieveData[0]->data;
        $total_price = $retrieveData[0]->total_price;

        if($retrieveData[0]->data[0]->order_payment_proof != null){
            $paymentImageLink = $retrieveData[0]->data[0]->order_payment_proof->proof_order_file;
        }else{
            $paymentImageLink = 'no-path';
        }

        return view('admin.order.order-receipt', compact('data', 'id', 'total_price', 'availableDriver', 'paymentImageLink'));

    }

     public static function guestOrderReceipt($id){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/guest-order-details', [
            "order_id" => $id,
        ]);

        $paymentImageLink = 'no-path';
        
        $availableDriver = User::whereIn('user_type', [2])->get();

        $retrieveData = json_decode($response);
        $data = $retrieveData[0]->data;
        $total_price = $retrieveData[0]->total_price;

        if($retrieveData[0]->data[0]->order_payment_proof != null){
            $paymentImageLink = $retrieveData[0]->data[0]->order_payment_proof->proof_order_file;
        }else{
            $paymentImageLink = 'no-path';
        }

        return view('admin.order.guest-order-receipt', compact('data', 'id', 'total_price', 'availableDriver', 'paymentImageLink'));

    }

    /**
    * Update multiple selected order.
    *
    * @param  Request  $request
    * @return Response
    */
    public function updateMultipleOrderStatus(Request $request){

        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/update-multiple-order-status', [
            "orderList" => $request->orderArray,
            "status" => $request->status
        ]);

        $retrieveData = json_decode($response);


    }


}
