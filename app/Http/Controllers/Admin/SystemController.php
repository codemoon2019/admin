<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;

class SystemController extends Controller
{

    /**
    * Product Inventory UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public function systemUsers(){
        return view('admin.system-users');
    }

    /**
    * Product Inventory UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public function driver(){
        return view('admin.driver');
    }

    /**
    * Product Inventory UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public function websiteBlogs(){
        return view('admin.website-blogs');
    }

    /**
    * Product Inventory UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public function userProfile(){
        return view('admin.user-profile');
    }


    /**
    * Create product.
    *
    * @param  Request  $request
    * @return Response
    */
    public function userList(Request $request){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/system-user-list', [
            "length" => $request->input('length'),
            "start" => $request->input('start'),
            "orderColumn" => $request->input('order.0.column'),
            "orderDirectory" => $request->input('order.0.dir'),
            "search" => $request->input('search.value'),
            "draw" => $request->input('draw')
        ]);

        return $response;

    }


    /**
    * Create product.
    *
    * @param  Request  $request
    * @return Response
    */
    public function driverList(Request $request){

        $columns = array(
            0 => 'id',
            1 => 'id',
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $draw = $request->input('draw');

        $totalData = User::with('userType')->whereIn('user_type', [2])->get()->count();

        $totalFiltered = $totalData;

        if(empty($request->input('search.value'))){

            $users = User::with('userType')->whereIn('user_type', [2])->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

        }else{

            $search =  $request->input('search.value'); 

            $users =  User::with('userType')->whereIn('user_type', [2])->where('id','LIKE',"%{$search}%")
                        ->orWhere('first_name', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->get();

            $totalFiltered = User::with('userType')->whereIn('user_type', [2])->where('id','LIKE',"%{$search}%")
                        ->orWhere('first_name', 'LIKE',"%{$search}%")
                        ->get()
                        ->count();
        }

        $data = array();

        if(!empty($users)){

            foreach ($users as $users){

                $nestedData['id'] = $users->id;
                $nestedData['name'] = $users->first_name.' '.$users->last_name;
                $nestedData['email'] = $users->email;
                $nestedData['phone'] = $users->phone;
                $nestedData['user_type'] = $users->userType->description;
                $nestedData['action'] = '<span class="btn btn-sm btn-warning radius-30 btn-edit" id="'.$users->id.'"><i class="fadeIn animated bx bx-edit"></i></span>
                <span class="btn btn-sm btn-danger radius-30 btn-delete" id="'.$users->id.'"><i class="fadeIn animated bx bx-trash-alt"></i></span>';
                $data[] = $nestedData;

            }
        
        }

        $json_data = array(
            "draw"            => intval($request->draw),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );
 
        return response()->json($json_data); 

    }

    /**
    * Register driver.
    *
    * @param  Request  $request
    * @return Response
    */
    public function registerDriver(Request $request){

        $generatedPassword = 123456;

        $user = new User;
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($generatedPassword);
        $user->phone = $request->phone;
        $user->user_type = 2;

        if($user->save()){

            return response()->json(['internalMessage' => 'Driver Registered Successfully']);

        }else{

            return response()->json(['internalMessage' => 'Something went wrong!']);

        }

    }


     /**
    * Register driver.
    *
    * @param  Request  $request
    * @return Response
    */
    public function registerAdmin(Request $request){

        $generatedPassword = 123456;

        $user = new User;
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($generatedPassword);
        $user->phone = $request->phone;
        $user->user_type = 1;

        if($user->save()){

            return response()->json(['internalMessage' => 'Driver Registered Successfully']);

        }else{

            return response()->json(['internalMessage' => 'Something went wrong!']);

        }

    }

    /**
    * Create website blog.
    *
    * @param  Request  $request
    * @return Response
    */
    public function createWebsiteBlog(Request $request){

        $main_image = 'no-path';
        
        if($request->hasFile('txtFile')){
            $primaryFilenameWithExt = $request->file('txtFile')->getClientOriginalName();
            $primaryFileName = pathinfo($primaryFilenameWithExt, PATHINFO_FILENAME);
            $primaryExtension = $request->file('txtFile')->getClientOriginalExtension();
            $primaryFileNameToStore = $primaryFileName.'_'.time().'.'.$primaryExtension;
            $path = $request->file('txtFile')->storeAs('public/website_blogs', $primaryFileNameToStore);
            $main_image = '/storage/website_blogs/'.$primaryFileNameToStore;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/create-website-blog', [
            "subject" => $request->input('txtSubject'),
            "description" => $request->input('txtDescription'),
            "image_url" => $main_image,
        ]);

        return $response;

    }

        /**
    * Create website blog.
    *
    * @param  Request  $request
    * @return Response
    */
    public function updateWebsiteBlog(Request $request){
     
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/update-website-blog', [
            "status" => $request->input('status'),
            "id" => $request->input('id')
        ]);

        return $response;

    }

    /**
    * Retrieve list of website.
    *
    * @param  Request  $request
    * @return Response
    */
    public function websiteBlogList(Request $request){

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('app.pure_api_key'),
            'Content-Type' => 'application/json'
        ])->post(config('app.pure_api_url').'api/website-blog-list', [
            "length" => $request->input('length'),
            "start" => $request->input('start'),
            "orderColumn" => $request->input('order.0.column'),
            "orderDirectory" => $request->input('order.0.dir'),
            "search" => $request->input('search.value'),
            "draw" => $request->input('draw')
        ]);

        return $response;
        
    }


    public function emails(){
        return view('comingsoon.index');
    }

    public function signupEmails(){
        return view('comingsoon.index');
    }

}
