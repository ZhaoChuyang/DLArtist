@extends('layouts.edit')

@section('script')

    <script>
        $.ajax({
            url: '/compose',
            method: 'get',
            dataType: 'json',
            data: {

                title: "弟弟",
                needSummary: true,
                summary: "网易体育2月28日报道：北京时间2月28日凌晨4点，英超联赛第28轮一场焦点战在斯坦福桥打响。",
                author: "点点滴滴",
            },
            success: function(response){
                console.log(response);
            },
            error: function(xhr){
                console.log(xhr);
            }
        })
    </script>

@endsection