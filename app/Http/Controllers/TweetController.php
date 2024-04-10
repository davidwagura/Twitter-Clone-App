<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tweet;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TweetController extends Controller
{

    public function home(){

        $tweets =  Tweet::all();

        return response()->json($tweets);

    }


    public function tweet(Request $request)
    {
        $tweet = new Tweet;

        $tweet->body = $request->body;

        $tweet->user_id = $request->user_id;

        // $tweet->likes = $request->likes;

        // $tweet->retweets = $request->retweets;

        $tweet->save();

        return response()->json($tweet);
    }

    public function user(Request $request)
    {
        $user = new User;

        $user->first_name = $request->first_name;

        $user->last_name = $request->last_name;

        $user->email = $request->email;

        $user->username = $request->username;

        $user->save();

        return response()->json($user);
    }

    public function comment(Request $request)
    {
        $comment = new Comment;

        $comment->body = $request->body;

        $comment->user_id = $request->user_id;

        $comment->tweet_id = $request->tweet_id;

        $comment->save();

        return response()->json($comment);

    }
    public function showTweet($id)
    {
        $tweet = Tweet::findOrFail($id);

        return response()->json($tweet);
    }

    public function comments($id)
    {
        $comment = Comment::where('tweet_id', $id)->get();

        return response()->json($comment);
    }

    public function userTweets($id)
    {
        // $comments = Comment::where( 'user_id', $id)->with( 'user')->get();

        $comments = Comment::where('tweet_id', $id)->with('tweet')->get();

        return response()->json($comments);
    }
    public function tweetComments($id)
    {
        $tweet = Tweet::with('comment')->findOrFail($id);

        return response()->json($tweet);
    }

    public function likeTweet($tweet_id, $user_id)
    {
        $tweet = Tweet::findOrFail($tweet_id);

            $likesId = $tweet->likes_id;

        if($likesId > '1'){

            $likesId = explode(',' , $likesId);

            if(!in_array($user_id, $likesId)) {
                $user_id = $user_id;  
    
                $likesId = $tweet->likes_id. ',' .$user_id;
        
                $tweet->likes_id = $likesId;

                $tweet->likes = $tweet->likes + 1;

            }
        }else{
            $tweet->likes_id = $user_id;
        }

        $tweet->save();

        return response()->json($tweet);
    }

    public function unretweet($tweet_id, $user_id)
    {
        $tweet = Tweet::findOrFail($tweet_id);


        $retweetsId = $tweet->retweets_id;


        $explodedRetweetsId = explode(',' , $retweetsId);

        // \Log::debug($explodedRetweetsId);


        $index = array_search(strval($user_id), $explodedRetweetsId);

        // \Log::debug($index);

        if ($index !== false) {

            unset($explodedRetweetsId[$index]);

        }

        $tweet->retweets_id = implode(',', $explodedRetweetsId);

        \Log::debug($tweet);

        $tweet->retweets = $tweet->retweets - 1;

        $tweet->save();

        return response()->json($tweet);
    }

    public function unlikeTweet($tweet_id, $user_id)
    {
        $tweet = Tweet::findOrFail($tweet_id);


        $likesId = $tweet->likes_id;


        $explodedLikesId = explode(',' , $likesId);


        $index = array_search(strval($user_id), $explodedLikesId);
        
        if ($index !== false) {

            unset($explodedLikesId[$index]);

        }

        $tweet->likes_id = implode(',', $explodedLikesId);

        $tweet->likes = $tweet->likes - 1;

        // \Log::debug($explodedLikesId);

        $tweet->save();

        return response()->json($tweet);
    }


    public function retweet($tweet_id, $user_id)
    {
        $tweet = Tweet::findOrFail($tweet_id);

        $retweetsId = $tweet->retweets_id;

        if($retweetsId > '1'){

            $retweetsId = explode(',' , $retweetsId);

            if(!in_array($user_id, $retweetsId)){

                $user_id = $user_id;

                $retweetsId = $tweet->retweets_id. ',' .$user_id;

                $tweet->retweets_id = $retweetsId;

                $tweet->retweets = $tweet->retweets + 1;
            }

                // \Log::debug($retweetsId);
        } else {
            $tweet->retweets_id = $user_id;
        }

        $tweet->save();

        return response()->json($tweet);

    }

    public function deleteTweet($tweet_id)
    {
        $tweet = Tweet::findOrFail($tweet_id);

        $tweet->delete();

        Session::flash('message', 'tweet deleted successfully');

        return response()->json($tweet);
    }

}   
