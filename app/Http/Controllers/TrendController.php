<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class TrendController extends Controller
{
    //テストアクション
    public function test()
    {
        $consumer_key ='RR3oA89ro96p8GSbb0o7fcJ0D';
        $consumer_secret ='KG9RpiBEqlXbzrnDtRdZJP9Lkfl7OV8vvfPEVIufvBEDgNf6Fp';
        $access_token ='1222152368063574022-wOgwjNtzeeR8njBzDBiiHyD729NI2A';
        $access_token_secret ='0xX6ChJM2GBzSwwfGEBTiJ3JCwp1YHBHbL9QeLklb2a0h';

        // APIに接続
        // $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

        // // アクセストークンを使用しているユーザーのタイムラインを10件取得する
        // $data = $connection->get('trends/place', ['id' => '2345896']);


        // $data = [
        //     'requests' => $request
        // ];
        // return $data;
        return view('trend.test');
    }

    public function home()
    {
        $consumer_key ='RR3oA89ro96p8GSbb0o7fcJ0D';
        $consumer_secret ='KG9RpiBEqlXbzrnDtRdZJP9Lkfl7OV8vvfPEVIufvBEDgNf6Fp';
        $access_token ='1222152368063574022-wOgwjNtzeeR8njBzDBiiHyD729NI2A';
        $access_token_secret ='0xX6ChJM2GBzSwwfGEBTiJ3JCwp1YHBHbL9QeLklb2a0h';

        //APIに接続
        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

        // アクセストークンを使用しているユーザーのタイムラインを10件取得する
        $requests = $connection->get('trends/place', ['id' => '1118370']);


        $data = [
            'requests' => $requests
        ];
    


        // return $data;
        
        return view('trend.home', $data);
    }


    public function explore(Request $req, $query)
    {
        
    
        $reqquery = ltrim($req->path(),'explore/');
        $req->session()->put('query',$reqquery);

        $consumer_key ='RR3oA89ro96p8GSbb0o7fcJ0D';
        $consumer_secret ='KG9RpiBEqlXbzrnDtRdZJP9Lkfl7OV8vvfPEVIufvBEDgNf6Fp';
        $access_token ='1222152368063574022-wOgwjNtzeeR8njBzDBiiHyD729NI2A';
        $access_token_secret ='0xX6ChJM2GBzSwwfGEBTiJ3JCwp1YHBHbL9QeLklb2a0h';

        //APIに接続
        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
        // $connection->post("statuses/update", array("status" => 'てすと'));
        $queryNew = ltrim($query,'#');

        //$queryの条件でツイートを検索
        $tweets = $connection->get('search/tweets', ['q' => $queryNew, 'count' => 10, 'result_type' => 'popular','exclude'=>'retweets']);

        $Hashquery = $query;
        if(strpos($query,'#') === false){
            $Hashquery = '#'.$query;
          }
        $data = [
            'trendName' => $query,
            'Hashquery' => $Hashquery,
            'tweets' => $tweets,
            'status' => null,
            'error' => null
        ];

        
        // foreach ($tweets as $id => $tweet) {
        //     return $tweet;
        // }

        // return $data;
        
        return view('trend.explore', $data);
    }

    public function tweet(Request $req){
        $consumer_key ='RR3oA89ro96p8GSbb0o7fcJ0D';
        $consumer_secret ='KG9RpiBEqlXbzrnDtRdZJP9Lkfl7OV8vvfPEVIufvBEDgNf6Fp';

        //$user = $req->session()->get('TwitterAuth',)
        $access_token ='1222152368063574022-wOgwjNtzeeR8njBzDBiiHyD729NI2A';
        $access_token_secret ='0xX6ChJM2GBzSwwfGEBTiJ3JCwp1YHBHbL9QeLklb2a0h';

        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
        //$connection->post("statuses/update", array("status" => 'てすと'));
        $status = $req->tweet;

        $query = $req->session()->get('query','未設定');

        if(mb_strlen($status) >= 140 || mb_strlen($status) <= 0){

            // $data = [
            //     'trendName' => '',
            //     'error' => '0文字以上140文字以内で入力してください。',
            //     'status' => $status
            // ];


        return redirect()->action('TrendController@explore',[ 'query' => $query ])->withInput()->with('alert','0文字以上140文字以内で入力してください。');

        }else{

            //$connection->post("statuses/update", array("status" => $status));

        }
        //送信されましたと共に
        return redirect()->action('TrendController@explore',[ 'query' => $query ])->withInput()->with('success','Tweetされました！');
        

    }
}
