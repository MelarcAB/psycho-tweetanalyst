<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Atymic\Twitter\Facade\Twitter;
use App\Models\Gpt;

class ApiController extends Controller
{


    function tweets($username)
    {
        $tweets = [];
        $lastTweetId = null;
        $params = [
            'screen_name' => $username,
            'count' => 30,
            'format' => 'array',
            'tweet_mode' => 'extended'
        ];

        $tweets_msg = [];



        $batch = Twitter::getUserTimeline($params);

        foreach ($batch as $tweet) {
            $tweets[] = [
                'username' => $tweet['user']['screen_name'],
                'tweet_id' => $tweet['id_str'],
                'date' => $tweet['created_at'],
                'message' => $tweet['full_text'],
                'reply_to' => $tweet['in_reply_to_screen_name'],
                'reply_to_id' => $tweet['in_reply_to_status_id_str'],
                'image' => $tweet['user']['profile_image_url_https']
            ];
            $tweets_msg[] = $tweet['full_text'] . $tweet['created_at'];
        }

        $response = [
            "tweets" => $tweets,
            "tweets_msg" => $tweets_msg,
            "batch" => $batch,
            "params" => $params,
            "username" => $username,
            "lastTweetId" => $lastTweetId,
        ];

        return json_encode($response);
    }


    function analisisGpt(Request $request)
    {
        $tweets = $request->input('tweets');
        $gpt = new Gpt("gpt-4");
        $tweets = implode(" \nSIGUIENTE TWEET: ", $tweets);

        return  $gpt->send(($tweets));
    }
}
