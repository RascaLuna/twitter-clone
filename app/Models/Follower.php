<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    // followerテーブルはincrementも使用せず、primary_key指定の設定

    protected $primalKey = [
        'following_id',
        'followed_id'
    ];

    protected $fillable = [
        'following_id',
        'followed_id'
    ];

    public $timestamps = false;
    public $incrementing = false;

    public function getFollowCount($user_id)
    {
        return $this->where('following_id', $user_id)->count();
    }

    public function getFollowerCount($user_id)
    {
        return $this->where('followed_id', $user_id)->count();
    }

    // フォローしているユーザIDを引数で渡し、フォローしているユーザーIDを取得する
    public function followingIds(Int $user_id)
    {
        return $this->where('following_id', $user_id)->get('followed_id');
    }
}
