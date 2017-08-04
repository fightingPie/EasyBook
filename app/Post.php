<?php

namespace App;


class Post extends Model
{
    //
//    protected $guarded;//不可以注入的字段
//    protected $fillable = ['title','content'];//可以注入的字段

    //关联用户
    public  function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    // 评论模型
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    //用户关联
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }

    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }
}
