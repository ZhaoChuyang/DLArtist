@extends('layouts.edit')

@section('head')
<style>
    .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: 1rem;
    }

    .container{
        max-width: 960px;
    }
</style>

@endsection

@section('content')
    <div class="container py-5 mt-5">
        <div class="row">
            <div class="col-md-3 pr-4">
                <h5 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">账号设置</span>
                </h5>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <a href="#"><h6 class="my-0">公开信息</h6></a>
                                <small class="text-muted">Brief description</small>
                            </div>

                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Second product</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Third item</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>EXAMPLECODE</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                        </li>
                    </ul>
                </h4>
            </div>

            <div class="col-md-8">
                
            </div>

        </div>
    </div>

@endsection

@section('script')
<script>
    $('#accountMenu').addClass('active');
</script>

@endsection