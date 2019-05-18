<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DLArtist\User;
use Illuminate\Support\Facades\Validator;
//use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class accounts extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public static function showAvatar(){
        $user_id=auth()->user()->id;
        $user=Cache::remember('user:'.$user_id, 1440, function(){
            return DB::table("users")->find(auth()->user()->id);
        });
        return 'storage'.$user->avatar_url;
    }

    public static function showInfo($info){
        //0--gender 1--birthday 2--bio
        $user=Cache::remember('user:'.auth()->user()->id, 1440, function(){
            return DB::table("users")->find(auth()->user()->id);
        });
        if($info==0)
            return $user->gender;
        else if($info==1)
            return $user->birthday;
        else if($info==2)
            return $user->bio;
    }

    public function storeAvatar(Request $request)
    {
        //!!!!!!注意修改php.ini中upload_max_size，否则无法上传2MB以上的文件
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|max:10240'
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        if ($request->hasFile('avatar')) {

            //retrieve user info
            $user=Cache::remember('user:'.auth()->user()->id, 1440, function (){
                return User::find(auth()->user()->id);
            });
            //$user=User::find(auth()->user()->id);
            $user_id=$user->id;
            //获取文件
            $avatar = $request->file('avatar');
            //重命名
            $inputImageName = '&'.$user_id.time() . '.' . $avatar->getClientOriginalExtension();
            //存储文件到/storages
            $destinatonPath = 'public/avatar';
            $path=$avatar->storeAs($destinatonPath, $inputImageName);
            //获取文件在public中的引用地址
            $finalPath = '/storage/avatar/'.$inputImageName;

            //获取用户之前的头像地址
            $previousAvatar = $user->avatar_url;
            //删除之前的头像
            if ($previousAvatar != '/avatar/default_avatar.png') {
                $previousAvatar =  'public' . $previousAvatar;
                Storage::delete($previousAvatar);
            }


            DB::beginTransaction();

            try {
                $user->avatar_url = '/avatar/'.$inputImageName;
                $user->save();
                Cache::forget('user:'.$user_id);
                Cache::add('user:'.$user_id, $user, 1440);
                DB::commit();
                return $finalPath;
            } catch (\Exception $ex) {
                DB::rollback();
                return response()->json(['error' => $ex->getMessage()], 500);
            }

        }

    }

    public function saveinfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        $username = $request->input('username');
        $birthday = $request->input('birthday');
        $bio = $request->input('bio');
        $gender = $request->input('gender');

        DB::beginTransaction();

        try {

            $id = auth()->user()->id;
            $user = Cache::remember('user:'.auth()->user()->id, 1440, function(){
                return DB::table('users')->find(auth()->user()->id);
            });
            $user->birthday = $birthday;
            $user->name = $username;
            $user->bio = $bio;
            $user->gender = $gender;
            $user->save();
            Cache::forget('user:'.$id);
            Cache::add('user:'.$id, $user, 1440);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }

        return response()->json('更新成功');
    }

    public function adminPwd(Request $request)
    {
        //auth()->user()->password=Hash::make("123456");
        $validator = Validator::make($request->all(), [
            'old_pwd' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->add('status', 0);
        }
        DB::beginTransaction();
        try {
            $old_pwd = $request->input('old_pwd');
            $new_pwd = $request->input('password');
            $current_pwd = auth()->user()->password;
            $user_id = auth()->user()->id;
            $user = auth()->user();
            if (Hash::check($old_pwd, $current_pwd)) {
                $user->password = Hash::make($new_pwd);
                $user->save();
                Cache::forget('user:'.$user_id);
                Cache::add('user:'.$user_id, $user, 1440);
                DB::commit();
            } else {
                return response()->json(['status' => [0], 'msg' => ["old password incorrect"]]);
            }
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }

        return response()->json(['status' => [1], 'msg' => ['password changed']]);

    }

    public function adminMail(Request $request)
    {
        $validator = Validator:: make($request->all(), [
            'email' => 'required|email',
            'phone' => 'digits:11|nullable'
        ]);
        if ($validator->fails()) {
            return $validator->errors()->add('status', 0);
        }

        DB::beginTransaction();
        try {
            $email = $request->input('email');
            $phone = $request->input('phone');
            $user = auth()->user();

            $checkEmail=User::where('email', $email)->first();
            if(!empty($checkEmail)){
                if($user->email!=$email)
                return response()->json(['status' => [0], 'msg' => ["email address has already been taken"]]);
            }
            $user->email = $email;
            $user->phone = $phone;
            Cache::forget('user:'.auth()->user()->id);
            Cache::add('user:'.auth()->user()->id, $user, 1440);
            $user->save();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage(), 'status'=>[2]]);
        }

        return response()->json(['status' => [1], 'msg' => ['updated']]);
    }
}
