<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DLArtist\User;

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
        $id=auth()->user()->id;
        $user=User::find($id);
        $user->birthday=$birthday;
        $user->name=$username;
        $user->bio=$bio;
        $user->save();
        return 1;
    }
}
