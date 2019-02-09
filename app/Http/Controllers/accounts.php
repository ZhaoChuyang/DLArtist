<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DLArtist\User;
use Validator;

class accounts extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeAvatar(Request $request){
        //!!!!!!注意修改php.ini中upload_max_size，否则无法上传2MB以上的文件
        $this->validate($request, [
            'avatar'=>'required|image|max:10240'
        ]);
        if($request->hasFile('avatar')){
            $avatar=$request->file('avatar');

            $inputImageName=time().'.'.$avatar->getClientOriginalExtension();
            $destinatonPath='avatar/';
            $avatar->move($destinatonPath, $inputImageName);

            $finalPath='/'.$destinatonPath.$inputImageName;

            $id=auth()->user()->id;
            $user=User::find($id);
            $previousAvatar=$user->avatar_url;
            //删除之前的头像
            if($previousAvatar!='/avatar/default_avatar.png'){
                $previousAvatar=public_path().$previousAvatar;
                if(file_exists($previousAvatar)){
                    unlink($previousAvatar);
                }
            }

            $user->avatar_url=$finalPath;
            $user->save();
            return $finalPath;
        }

    }
    public function saveinfo(Request $request){
        $this->validate($request, [
            'username' => 'required',
        ]);
        $username=$request->input('username');
        $birthday=$request->input('birthday');
        $bio=$request->input('bio');
        $gender=$request->input('gender');
        $id=auth()->user()->id;
        $user=User::find($id);
        $user->birthday=$birthday;
        $user->name=$username;
        $user->bio=$bio;
        $user->gender=$gender;
        $user->save();
        return 1;
    }

    public function adminPwd(Request $request){

        $validator=Validator:: make($request->all(),[
            'old_pwd'=>'required',
            'password'=>'required|confirmed|min:6',
        ]);
        if($validator->fails()){
            return $validator->errors()->add('status', 0);
        }

        $old_pwd=$request->input('old_pwd');
        $new_pwd=$request->input('new_pwd');
        $current_pwd=auth()->user()->password;
        $user_id=auth()->user()->id;
        $user=User::find($user_id);
        if(\Hash::check($old_pwd, $current_pwd)){
            $user->password=\Hash::make($new_pwd);
            $user->save();
            return response()->json(['status'=>[1], 'msg'=>['password changed']]);
        }

        return response()->json(['status'=>[0], 'msg'=>['old password incorrect']]);



    }

    public function adminMail(Request $request){
        $validator=Validator:: make($request->all(),[
            'email'=>'required|email',
            'phone'=>'digits:11'
        ]);
        if($validator->fails()){
            return $validator->errors()->add('status', 0);
        }
        $email=$request->input('email');
        $phone=$request->input('phone');
        $user=User::find(auth()->user()->id);
        $user->email=$email;
        $user->phone=$phone;
        $user->save();
        return response()->json(['status'=>[1], 'msg'=>['updated']]);
    }
}
