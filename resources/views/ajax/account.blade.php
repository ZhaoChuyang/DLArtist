@if($info=='publicInfo')
    <h5 class="mb-3 border-bottom" style="padding-bottom: 15px;">个人信息</h5>
    <div class="row ">
        <div class="col-9">

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="firstName">用户名</label>
                        <input type="text" class="form-control" id="username" placeholder="" value="" required="">
                    </div>
                </div>


                {{--<div class="mb-3">--}}
                {{--<label for="email">邮箱地址 <span class="text-muted"></span></label>--}}
                {{--<input type="email" class="form-control" id="email" placeholder="you@example.com">--}}
                {{--<div class="invalid-feedback">--}}
                {{--Please enter a valid email address for shipping updates.--}}
                {{--</div>--}}
                {{--</div>--}}

                <div class="mb-3">
                    <label for="birthday">生日<span class="text-muted">(可选)</span></label>
                    <input type="text" class="form-control" id="birthday" placeholder="1901/01/01" required="">
                </div>

                <div class="mb-3">
                    <label for="bio">个人简介 <span class="text-muted">(可选)</span></label>
                    <textarea class="form-control" style="height: 100px;" id="bio" placeholder="介绍一下你自己"></textarea>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="20" viewBox="0 3 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-activity">
                            <polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon>
                            <line x1="3" y1="22" x2="21" y2="22"></line>
                        </svg>
                        上传头像</a>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>

    <script>
        $('#uploadAvatar').click(function () {
                var form=$('#avatarForm')[0];
                var formData=new FormData(form);
                $.ajax({
                    contentType: false,
                    processData: false,
                    url: "/accounts/avatar",
                    type: "post",
                    data: formData,
                    success: function (response) {
                        console.log(response);
                        $('#curAvatar').attr('src',response);
                    }
                })
            }
        );
        $("#save").click(function () {
            $.ajax({
                type:"post",
                url:"/accounts/save",
                data:{"_token":'{{csrf_token()}}',"username":$("#username").val(),"birthday":$("#birthday").val(),"bio":$("#bio").val()},
                success:function (response) {
                    console.log(response);
                },
                error:function (xhr) {
                    alert(xhr.status);
                }
            })
        })
    </script>

@else
    <p>elseContent</p>
@endif