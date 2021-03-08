@extends('layouts.base')
@section('title','Home')
@section('main')
    <div class="container">
    <div class="row">
    <div class="pricing-header mt-5 px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">現在のトレンド</h1>
        <p class="lead">ツイッターにおける現在のトレンド一覧</p>
    </div>
    </div>

        <div class="row d-flex justify-content-around">
            @foreach ($requests as $request)
            @foreach ($request->trends as $trend)
                <div class="card-deck col-xl-4 col-lg-6 mb-1 text-center">
                    <div class="card  mb-5 shadow-sm " style="width: 20rem;">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">{{$trend->name}}</h4>
                    </div>
                    <div class="card-body">
                        <!-- <h1 class="card-title pricing-card-title">￥0 <small class="text-muted">/ 月</small></h1> -->
                        <ul class="list-unstyled mt-3 mb-4">
                            @if(!empty($trend->tweet_volume))
                            <li>ツイート数:{{$trend->tweet_volume}}</li>
                            @else
                            <li>ツイート数:情報なし</li>
                            @endif
                        </ul>
                        <a style="text-decoration:none;" href="explore/{{ $trend->query }}">
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary">関連ツイートを見る</button>
                        </a>
                    </div>
                    </div>
                </div>
            @endforeach
            @endforeach
        </div>
    </div>
@endsection

