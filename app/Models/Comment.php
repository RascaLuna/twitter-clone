<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use SoftDeletes;

     // 登録/更新を許可するためにtextカラムのみ指定
     Protected $fillable = [
        'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // getTweet()で取得した情報に紐づいたコメント情報を取得
    public function getComments(Int $tweet_id)
    {
        return $this->with('user')->where('tweet_id', $tweet_id)->get();
    }

    // 引数はコメントしたユーザID $user_idとコメント $data
    public function commentStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->tweet_id = $data['$tweet_id'];
        $this->text = $data['text'];
        $this->save();

        return;
    }
}
