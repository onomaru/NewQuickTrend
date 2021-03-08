@extends('layouts.base')
@section('title','Detail')
@section('main')
<div class="container">
  <main role="main">
    <div class="jumbotron">
      <div class="col-sm-8 mx-auto">
        <h1>{{$trendName}}</h1>
        <!-- <p>これはナビゲーションバーとコンテンツがどう動作するかを示すサンプルです．いくつかのナビゲーションバーはビューポートのサイズによって拡大し，他のものはコンテナのサイズに制限されます．ナビゲーションバーの配置のため，<a href="../navbar-static/">画面上</a> や <a href="../navbar-fixed/">画面上に固定</a> を確認してください．</p>
        <p>最小のブレークポイントにおいては，ナビゲーションバーをたたみ，リンクなどのコンテンツを隠すためのプラグインを使用し，表示をトグルさせるためのボタンが表示されます．</p>
        <p> -->
          <a class="btn btn-primary" href="/home" role="button">トレンド一覧ページに戻る</a>
        </p>
      </div>
    </div>
  </main>

<div class="form-group">
    <!-- 成功メッセージ -->
    @if(session('success'))
    <div class="alert alert-success" role="alert">
    {{session('success')}}
    </div>
    @endif
    <!-- エラーメッセージ -->
    @if(session('alert'))
    <div class="alert alert-danger" role="alert">
    {{session('alert')}}
    </div>
    @endif

    <form method="POST" action="/tweet">
    @csrf
        <label for="exampleFormControlTextarea1">Tweet</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name='tweet' rows="3">
        @if(empty($status))    
        {{$Hashquery}}
        @else
        {{$status}}
        @endif
        </textarea>
        <div class="text-right">
        <button type="submit" class="btn btn-outline-primary mt-2">Tweet</button>
        </div>
    </form>
</div>

<div class="row d-flex justify-content-around">
  <!-- 取得したツイート -->
  @foreach($tweets as $id => $tweet)
    @foreach($tweet as $id => $tw)
        @if($id == 'completed_in')
        @break
        @endif
        <div class="card-deck col-xl-4 col-lg-6 mb-5 text-center">
        <div class="card" style="width: 20rem;">
            <div class="card-body">


                <h5 class="card-title">@ {{$tw->user->screen_name}}</h5>
                <h5 class="card-subtitle">{{$tw->user->name}}</h5>
                </br>
                <p>{{$tw->text}}</p>

                @foreach($tw->entities->urls as $url)
                <a href="{{$url->expanded_url}}" class="btn btn-dark">関連リンク</a>
                @endforeach

            </div>
        </div>
        </div>
    
    @endforeach
  @endforeach
</div>
</div>
@endsection

