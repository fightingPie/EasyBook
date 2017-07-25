<?php

namespace App\Http\Controllers;

//use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //列表页面
    public function index()
    {
//        echo 123;exit();
        return view("post/index");
    }
    //详情页面
    public function show()
    {
       return view('post/show',['title'=>'this is title','isShow'=>false]);
    }
    //创建文章
    public function create()
    {
       return view('post/create');
    }
    //创建逻辑
    public function store()
    {
        
    }
    //编辑页面
    public function edit()
    {
       return view('post/edit');
    }
    //编辑逻辑
    public function update()
    {
        
    }
    //删除页面
    public function delete()
    {
        
    }
}
