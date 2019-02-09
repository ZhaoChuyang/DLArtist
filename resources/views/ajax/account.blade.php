@if($info=='publicInfo')
    <h5 class="mb-3 border-bottom" style="padding-bottom: 15px;">个人信息</h5>
    <div class="row ">
        <div class="col-9">

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="firstName">用户名</label>
                    <input type="text" class="form-control" id="username" placeholder="" value={{auth()->user()->name}}>
                </div>
            </div>


            {{--<div class="mb-3">--}}
            {{--<label for="email">邮箱地址 <span class="text-muted"></span></label>--}}
            {{--<input type="email" class="form-control" id="email" placeholder="you@example.com">--}}
            {{--<div class="invalid-feedback">--}}
            {{--Please enter a valid email address for shipping updates.--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="mb-3" id="gender">
                <label for="">性别<span class="text-muted">(可选)</span></label>
                <br>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" value="0">
                    <label class="custom-control-label" for="customRadioInline1">男</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" value="1">
                    <label class="custom-control-label" for="customRadioInline2">女</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="birthday">生日<span class="text-muted">(可选)</span></label>
                <input type="date" class="form-control" id="birthday" placeholder="1901-01-01"
                       value={{auth()->user()->birthday}}>
            </div>

            <div class="mb-3">
                <label for="bio">个人简介 <span class="text-muted">(可选)</span></label>
                <textarea class="form-control" style="height: 100px;" id="bio" placeholder="介绍一下你自己"
                          >{{auth()->user()->bio}}</textarea>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit" id="save">更新信息</button>
        </div>
        <div class="col-3 pl-4">
            <p>个人头像</p>
            <div>
                <img id="curAvatar"
                     class="border"
                     style="display: inline-block;line-height: 1;overflow: hidden;vertical-align: middle;border-radius: 6px!important;"
                     src="{!! \DLArtist\User::find($user_id)->avatar_url !!}"
                     width="200" height="200" alt="{{Auth::user()->name}}">
                <form method="post" id="avatarForm">
                    {{ csrf_field() }}
                    <label class="btn btn-secondary btn-sm mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 3 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-activity">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                        </svg>
                        选择图片<input id="avatar" name="avatar" type="file" hidden>
                    </label>
                    <a id="uploadAvatar" class="btn btn-dark btn-sm text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 3 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg>
                        上传头像</a>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
           var gender="{!! \DLArtist\User::find($user_id)->gender !!}";
           if(gender==0){
               $('#customRadioInline1').attr('checked', true);
           }
           else{
               $('#customRadioInline2').attr('checked', true);
           }
        });
        $('#uploadAvatar').click(function () {
                var form = $('#avatarForm')[0];
                var formData = new FormData(form);
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: "/accounts/avatar",
                    type: "post",
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        $('#curAvatar').attr('src', response);
                        alert('上传成功');
                    }
                })
            }
        );
        $("#save").click(function () {
            $.ajax({
                type: "post",
                url: "/accounts/save",
                data: {
                    "_token": '{{csrf_token()}}',
                    "username": $("#username").val(),
                    "birthday": $("#birthday").val(),
                    "bio": $("#bio").val(),
                    "gender": $("#gender input[type='radio']:checked").val()
                },
                dataType: 'json',
                success: function (response) {
                    alert(response);
                    console.log(response);
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            })
        })
    </script>

@elseif($info=='accountInfo')

    <h5 class="mb-3 border-bottom" style="padding-bottom: 15px;">修改密码</h5>
    <div class="row ">
        <div class="col-10">

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="old_pwd">旧密码</label>
                    <input type="password" class="form-control" id="old_pwd" placeholder="" value="" required="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="new_pwd">新密码</label>
                    <input type="password" class="form-control" id="new_pwd" placeholder="" value="" required="">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="cfm_pwd">确认密码</label>
                    <input type="password" class="form-control" id="cfm_pwd" placeholder="" value="" required="">
                </div>
            </div>

            <button class="btn btn-secondary btn" id="update_pwd">更新密码</button>

            {{--<div class="mb-3">--}}
            {{--<label for="email">邮箱地址 <span class="text-muted"></span></label>--}}
            {{--<input type="email" class="form-control" id="email" placeholder="you@example.com">--}}
            {{--<div class="invalid-feedback">--}}
            {{--Please enter a valid email address for shipping updates.--}}
            {{--</div>--}}
            {{--</div>--}}
            <h5 class="mb-3 border-bottom mt-5" style="padding-bottom: 15px;">更新邮箱/电话</h5>
            <div class="mb-3">
                <label for="email">邮箱</label>
                <input type="text" class="form-control" id="email" placeholder="1901/01/01"
                       value="{{auth()->user()->email}}">
            </div>
            <div class="mb-3">
                <label for="phone">电话<span class="text-muted">(可选)</span></label>
                <input type="text" class="form-control" id="phone" placeholder="输入手机号"
                       value="{{auth()->user()->phone}}">
            </div>
            <button class="btn btn-secondary btn mt-1" id="update_mail">更新信息</button>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>

    <script>
        $("#update_pwd").click(function () {
            $.ajax({
                type: "post",
                url: "/accounts/adminPwd",
                data: {
                    "_token": '{{csrf_token()}}',
                    "old_pwd": $("#old_pwd").val(),
                    "password": $("#new_pwd").val(),
                    "password_confirmation": $("#cfm_pwd").val(),
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status[0]===1) {
                        alert("password changed successful");
                    }
                    else if(response.status[0]===0) {
                        if (typeof response.password !== 'undefined') {
                            for (let i = 0; i < response.password.length; i++) {
                                console.log(response.password[i]);
                            }
                        }
                        if (typeof response.old_pwd !== 'undefined') {
                            for (let i = 0; i < response.old_pwd.length; i++) {
                                console.log(response.old_pwd[i]);
                            }
                        }
                        if (typeof response.msg !== 'undefined') {
                            for (let i = 0; i < response.msg.length; i++) {
                                console.log(response.msg[i]);
                            }
                        }

                    }
                    else if(response.status[0]===2){
                        console.log(response);
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            })
        });

        $("#update_mail").click(function () {
            $.ajax({
                type: "post",
                url: "/accounts/adminMail",
                data: {
                    "_token": '{{csrf_token()}}',
                    "email": $("#email").val(),
                    "phone": $("#phone").val(),
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.status[0]) {
                        alert("updated successful");
                    }
                    else {
                        if (typeof response.phone !== 'undefined') {
                            for (let i = 0; i < response.phone.length; i++) {
                                console.log(response.phone[i]);
                            }
                        }
                        if (typeof response.email !== 'undefined') {
                            for (let i = 0; i < response.email.length; i++) {
                                console.log(response.email[i]);
                            }
                        }
                        if (typeof response.msg !== 'undefined') {
                            for (let i = 0; i < response.msg.length; i++) {
                                console.log(response.msg[i]);
                            }
                        }

                    }
                },
                error: function (xhr) {
                    alert(xhr.status);
                }
            })
        })
    </script>

@endif