<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;


Route::post('/login', [TweetController::class, 'login']);

Route::post('/logout', [TweetController::class, 'logout']);

Route::get('/', [TweetController::class, 'home']);

Route::post('/tweet', [TweetController::class, 'tweet']);

Route::post('/user', [TweetController::class, 'user']);

Route::post('/tweet/comment', [TweetController::class, 'comment']);

Route::post('/like/{tweet_id}/{user_id}', [TweetController::class, 'likeTweet']);

Route::post('/unlike/{tweet_id}/{likes_id}', [TweetController::class, 'unlikeTweet']);

Route::post('/retweet/{tweet_id}/{user_id}', [TweetController::class, 'retweet']);

Route::post('/unretweet/{tweet_id}/{likes_id}', [TweetController::class, 'unretweet']);

Route::post('/resetPassword/{user_id}', [TweetController::class, 'resetPassword']);

Route::post('/followers/{follower_id}/{user_to_follow_id}', [TweetController::class, 'followers']);

Route::post('/unfollow/{follower_id}/{user_id}', [TweetController::class, 'followersUnFollow']);

Route::post('/following/{following_id}/{user_to_follow_id}', [TweetController::class, 'following']);

Route::post('/unfollowing/{following_id}/{user_id}', [TweetController::class, 'followingUnFollow']);









Route::get('/tweet/{id}', [TweetController::class, 'showTweet']);

Route::get('/comment/{id}', [TweetController::class, 'comments']);

Route::get('/user/tweets/{id}', [TweetController::class, 'userTweets']);

Route::get('tweet/comments/{id}', [TweetController::class, 'tweetComments']);

Route::get('/profile/{user_id}', [TweetController::class, 'profile']);

Route::delete('tweet/delete/{tweet_id}', [TweetController::class, 'deleteTweet']);

Route::get('/myFollowers/{myId}/{followerId}', [TweetController::class, 'showFollowers']);

Route::get('/following/{myId}/{followingId}',[TweetController::class, 'following']);

Route::get('/showFollowers/{myId}/{followerId}', [TweetController::class, 'showFollowers']);
