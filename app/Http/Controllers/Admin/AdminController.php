<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class AdminController extends Controller
{
    
    public static function index(){

        if(auth()->user()->user_type == 1){

            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.config('app.pure_api_key'),
                'Content-Type' => 'application/json'
            ])->get(config('app.pure_api_url').'api/dashboard-report');
            
            $responseGuest = Http::withHeaders([
                'Authorization' => 'Bearer '.config('app.pure_api_key'),
                'Content-Type' => 'application/json'
            ])->get(config('app.pure_api_url').'api/guest-dashboard-report');

            $data = json_decode($response);   

            $dataGuest = json_decode($responseGuest);

            $productOrder = $data[0]->recentOrder;
      

            $productListGuest = $dataGuest[0]->productList;

            $productOrderGuest = $dataGuest[0]->recentOrder;
      

            $productList = $data[0]->productList;
        
    
            return view('admin.index', compact('data','productList', 'productOrder', 'productListGuest', 'productOrderGuest'));
        }else{

            return view('admin.order.new');
            
        }

    }


    public static function myProfile(){

        return view('admin.profile.index');
    
    }

    public static function uploadUserImage(Request $request){

        $main_image = null;

        if($request->hasFile('txtFileProfilePicture')){
            $primaryFilenameWithExt = $request->file('txtFileProfilePicture')->getClientOriginalName();
            $primaryFileName = pathinfo($primaryFilenameWithExt, PATHINFO_FILENAME);
            $primaryExtension = $request->file('txtFileProfilePicture')->getClientOriginalExtension();
            $primaryFileNameToStore = $primaryFileName.'_'.time().'.'.$primaryExtension;
            $path = $request->file('txtFileProfilePicture')->storeAs('public/profile_images', $primaryFileNameToStore);
            $main_image = 'storage/profile_images/'.$primaryFileNameToStore;
        }

        $updateUserProfile = User::find(auth()->user()->id);
        $updateUserProfile->profile_picture_url = $main_image;
        $updateUserProfile->save();

        return 'success';

    }

    public static function uploadUserProfile(Request $request){

        $updateUserProfile = User::find(auth()->user()->id);
        $updateUserProfile->first_name = $request->txtFirstname;
        $updateUserProfile->last_name = $request->txtLastname;

        $findIfTheemailExist = User::where('email', $request->txtEmail);
        $findIfThenumberExist = User::where('phone', $request->txtPhonenumber);

        if($request->txtEmail != auth()->user()->email){
            if($findIfTheemailExist->get()->count() != 0){
                return array(['success' => false, 'message' => 'Email already used! Please try another email!']);
            }else{
                $updateUserProfile->email = $request->txtEmail;
            }
        }

        if($request->txtPhonenumber != auth()->user()->phone){
            if($findIfThenumberExist->get()->count() != 0){
                return array(['success' => false, 'message' => 'Phone already used! Please try another email!']);
            }else{
                $updateUserProfile->phone = $request->txtPhonenumber;
            }
        }

        $hashedPassword = User::find(auth()->user()->id)->password;

        if (!Hash::check($request->txtCurrentPassword, $hashedPassword)) {
            
            return array(['success'=>false, 'message' => 'You enter the wrong password please try again.']);
         
        }else{

            if($request->txtNewPassword == $request->txtRetypePassword){

                $updateUserProfile->password = Hash::make($request->txtNewPassword);
        
            } else {

                return array(['success' => false, 'message' => 'Password not matched!']); 
            
            }
         
        }

        $updateUserProfile->save();

        return array(['success' => true, 'message' => 'Updated successfully!']);

    }

}
