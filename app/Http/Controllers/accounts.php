<?php

namespace DLArtist\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DLArtist\User;
use Validator;
use Illuminate\Support\Facades\DB;

class accounts extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function storeAvatar(Request $request)
    {
        //!!!!!!注意修改php.ini中upload_max_size，否则无法上传2MB以上的文件
        $this->validate($request, [
            'avatar' => 'required|image|max:10240'
        ]);
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');

            $inputImageName = time() . '.' . $avatar->getClientOriginalExtension();
            $destinatonPath = 'avatar/';
            $avatar->move($destinatonPath, $inputImageName);

            $finalPath = '/' . $destinatonPath . $inputImageName;

            $id = auth()->user()->id;
            $user = User::find($id);
            $previousAvatar = $user->avatar_url;
            //删除之前的头像
            if ($previousAvatar != '/avatar/default_avatar.png') {
                $previousAvatar = public_path() . $previousAvatar;
                if (file_exists($previousAvatar)) {
                    unlink($previousAvatar);
                }
            }

            DB::beginTransaction();

            try {
                $user->avatar_url = $finalPath;
                $user->save();
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
        $this->validate($request, [
            'username' => 'required',
        ]);
        $username = $request->input('username');
        $birthday = $request->input('birthday');
        $bio = $request->input('bio');
        $gender = $request->input('gender');

        DB::beginTransaction();

        try {

            $id = auth()->user()->id;
            $user = User::find($id);
            $user->birthday = $birthday;
            $user->name = $username;
            $user->bio = $bio;
            $user->gender = $gender;
            $user->save();
            DB::commit();

        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }

        return response()->json('更新成功');
    }

    public function adminPwd(Request $request)
    {

        $validator = Validator:: make($request->all(), [
            'old_pwd' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return $validator->errors()->add('status', 0);
        }
        DB::beginTransaction();
        try {
            $old_pwd = $request->input('old_pwd');
            $new_pwd = $request->input('new_pwd');
            $current_pwd = auth()->user()->password;
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            if (\Hash::check($old_pwd, $current_pwd)) {
                $user->password = \Hash::make($new_pwd);
                $user->save();
                DB::commit();
            } else {
                return response()->json(['status' => [0], 'msg' => ['old password incorrect']]);
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
            $user = User::find(auth()->user()->id);

            $checkEmail=User::where('email', $email);
            if(!empty($checkEmail)){
                return response()->json(['status' => [0], 'msg' => ['email has alredy been taken']]);
            }
            $user->email = $email;
            $user->phone = $phone;
            $user->save();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage(), 'status'=>[2]]);
        }

        return response()->json(['status' => [1], 'msg' => ['updated']]);
    }
}
