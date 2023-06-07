<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Atymic\Twitter\Facade\Twitter;
use App\Models\Gpt;
use Atymic\Twitter\Exception\TwitterException;
use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;


class ApiController extends Controller
{

    function tweets($username)
    {
        try {
            $consumerKey = env('TWITTER_CONSUMER_KEY');
            $consumerSecret = env('TWITTER_CONSUMER_SECRET');
            $accessToken = env('TWITTER_ACCESS_TOKEN');
            $accessSecret = env('TWITTER_ACCESS_TOKEN_SECRET');

            $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessSecret);

            $tweets = [];
            $params = [
                'screen_name' => $username,
                'count' => 15,
                'exclude_replies' => true,
                'include_rts' => false,
                'tweet_mode' => 'extended'
            ];

            $tweets_msg = [];

            $batch = $connection->get("statuses/user_timeline", $params);

            if ($connection->getLastHttpCode() != 200) {
                throw new TwitterOAuthException('Error al recuperar tweets.');
            }

            foreach ($batch as $tweet) {
                $tweets[] = [
                    'username' => $tweet->user->screen_name,
                    'tweet_id' => $tweet->id_str,
                    'date' => $tweet->created_at,
                    'message' => isset($tweet->full_text) ? $tweet->full_text : '',
                    'reply_to' => $tweet->in_reply_to_screen_name,
                    'reply_to_id' => $tweet->in_reply_to_status_id_str,
                    'image' => $tweet->user->profile_image_url_https
                ];
                $tweets_msg[] = $tweet->full_text . $tweet->created_at;
            }

            $response = [
                "tweets" => $tweets,
                "tweets_msg" => $tweets_msg,
                "batch" => $batch,
                "params" => $params,
                "username" => $username,
            ];

            return json_encode($response);
        } catch (TwitterOAuthException $e) {
            return json_encode([
                "error" => $e->getMessage()
            ]);
        }
    }

    function tweetsLegacy($username)
    {
        try {
            $tweets = [];
            $lastTweetId = null;
            $params = [
                'screen_name' => $username,
                'count' => 15,
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
        } catch (TwitterException $e) {
            return json_encode([
                "error" => $e->getMessage()
            ]);
        }
    }


    function analisisGpt(Request $request)
    {
        $tweets = $request->input('tweets');
        $gpt = new Gpt();
        $tweets = implode(" \nSIGUIENTE TWEET: ", $tweets);
        return  $gpt->send(($tweets));
    }
}
