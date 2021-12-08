<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Response;

class ProductController extends Controller
{
    
    /**
    * Create Product UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public function index(){
        return view('admin.product.create');
    }

    /**
    * Product Inventory UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public function inventory(){
        return view('admin.product.inventory');
    }
    
    /**
    * Create product.
    *
    * @param  Request  $request
    * @return Response
    */
    public function createProduct(Request $request){

        $arrayData = [];
        $arrayImages = [];
        $main_image = 'no-path';
        $lorikeet_image = 'no-path';
        
        if($request->hasFile('txtProductPrimaryImage')){
            $primaryFilenameWithExt = $request->file('txtProductPrimaryImage')->getClientOriginalName();
            $primaryFileName = pathinfo($primaryFilenameWithExt, PATHINFO_FILENAME);
            $primaryExtension = $request->file('txtProductPrimaryImage')->getClientOriginalExtension();
            $primaryFileNameToStore = $primaryFileName.'_'.time().'.'.$primaryExtension;
            $path = $request->file('txtProductPrimaryImage')->storeAs('public/product_images', $primaryFileNameToStore);
            $main_image = '/storage/product_images/'.$primaryFileNameToStore;
        }

        if($request->hasFile('txtProductAdditionalImage')){
            foreach($request->file('txtProductAdditionalImage') as $value){
                
                $secondaryFilenameWithExt = $value->getClientOriginalName();
                $secondaryFileName = pathinfo($secondaryFilenameWithExt, PATHINFO_FILENAME);
                $secondaryExtension = $value->getClientOriginalExtension();
                $secondaryFileNameToStore = $secondaryFileName.'_'.time().'.'.$secondaryExtension;
                $secondarypath = $value->storeAs('public/product_images', $secondaryFileNameToStore);
                $secondary_image = '/storage/product_images/'.$secondaryFileNameToStore;

                $arrayImages = Arr::prepend($arrayImages, $secondary_image);
            };
        }

        if($request->hasFile('txtLorikeet')){
            $lorikeetFilenameWithExt = $request->file('txtLorikeet')->getClientOriginalName();
            $lorikeetFileName = pathinfo($lorikeetFilenameWithExt, PATHINFO_FILENAME);
            $lorikeetExtension = $request->file('txtLorikeet')->getClientOriginalExtension();
            $lorikeetFileNameToStore = $lorikeetFileName.'_'.time().'.'.$lorikeetExtension;
            $path = $request->file('txtLorikeet')->storeAs('public/lorikeet_images', $lorikeetFileNameToStore);
            $lorikeet_image = '/storage/lorikeet_images/'.$lorikeetFileNameToStore;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/create-product', [
            "product_name" => $request->txtProductName,
            "product_description" => $request->description,
            "product_status" => $request->txtProductStatus,
            "product_stock" => $request->txtProductStock,
            "product_type" => 1,
            "product_original_price" => $request->txtProductOriginalPrice,
            "product_retail_price" => $request->txtProductRetailPrice,
            "gift_points" => $request->txtGiftPoints,
            "main_image" => $main_image,
            "lorikeet_image" => $lorikeet_image,
            "additional_images" => $arrayImages,
        ]);

        return $response;

    }


    public function productList(Request $request){
    
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.config('app.pure_api_key'),
                'Content-Type' => 'application/json'
            ])->post(config('app.pure_api_url').'api/product-list', [
                "length" => $request->input('length'),
                "start" => $request->input('start'),
                "orderColumn" => $request->input('order.0.column'),
                "orderDirectory" => $request->input('order.0.dir'),
                "search" => $request->input('search.value'),
                "draw" => $request->input('draw')
            ]);
    
            return $response;

    }


    public function retrieveSingleProductInfo($id){
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/retrieve-single-product-info', [
            "id" => $id,
        ]);

        $retrieveData = json_decode($response);

        return view('admin.product.single-product-info', compact('retrieveData','id'));

    }


    public static function deleteProductImage(Request $request){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/delete-product-image', [
            "id" => $request->id,
        ]);

        $retrieveData = json_decode($response);

        return $retrieveData;

    }


    public static function updateProduct(Request $request){

        $arrayData = [];
        $arrayImages = [];
        $main_image = 'no-path';
        $lorikeet_image = 'no-path';

        if($request->hasFile('txtProductPrimaryImage')){
            $primaryFilenameWithExt = $request->file('txtProductPrimaryImage')->getClientOriginalName();
            $primaryFileName = pathinfo($primaryFilenameWithExt, PATHINFO_FILENAME);
            $primaryExtension = $request->file('txtProductPrimaryImage')->getClientOriginalExtension();
            $primaryFileNameToStore = $primaryFileName.'_'.time().'.'.$primaryExtension;
            $path = $request->file('txtProductPrimaryImage')->storeAs('public/product_images', $primaryFileNameToStore);
            $main_image = '/storage/product_images/'.$primaryFileNameToStore;
        }

        if($request->hasFile('txtProductAdditionalImage')){
            foreach($request->file('txtProductAdditionalImage') as $value){
                
                $secondaryFilenameWithExt = $value->getClientOriginalName();
                $secondaryFileName = pathinfo($secondaryFilenameWithExt, PATHINFO_FILENAME);
                $secondaryExtension = $value->getClientOriginalExtension();
                $secondaryFileNameToStore = $secondaryFileName.'_'.time().'.'.$secondaryExtension;
                $secondarypath = $value->storeAs('public/product_images', $secondaryFileNameToStore);
                $secondary_image = '/storage/product_images/'.$secondaryFileNameToStore;

                $arrayImages = Arr::prepend($arrayImages, $secondary_image);
            };
        }

        if($request->hasFile('txtLorikeet')){
            $lorikeetFilenameWithExt = $request->file('txtLorikeet')->getClientOriginalName();
            $lorikeetFileName = pathinfo($lorikeetFilenameWithExt, PATHINFO_FILENAME);
            $lorikeetExtension = $request->file('txtLorikeet')->getClientOriginalExtension();
            $lorikeetFileNameToStore = $lorikeetFileName.'_'.time().'.'.$lorikeetExtension;
            $path = $request->file('txtLorikeet')->storeAs('public/lorikeet_images', $lorikeetFileNameToStore);
            $lorikeet_image = '/storage/lorikeet_images/'.$lorikeetFileNameToStore;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/update-product', [
            "id" => $request->txtId,
            "product_name" => $request->txtProductName,
            "product_description" => $request->description,
            "product_status" => $request->txtProductStatus,
            "product_stock" => $request->txtProductStock,
            "product_type" => 1,
            "product_original_price" => $request->txtProductOriginalPrice,
            "product_retail_price" => $request->txtProductRetailPrice,
            "gift_points" => $request->txtGiftPoints,
            "main_image" => $main_image,
            "lorikeet_image" => $lorikeet_image,
            "additional_images" => $arrayImages,
        ]);

        return $response;

    }


    public function deleteProduct(Request $request){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/delete-product', [
            "id" => $request->id,
        ]);

        return $response;

    }



}
