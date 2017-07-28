<?php

namespace App\Http\Controllers;

//use App\Post;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //列表页面
    public function index()
    {
//        echo 123;exit();
        $posts = Post::orderBy('created_at','desc')->paginate(6);
//        dd($posts);
        return view("post/index",compact('posts'));
    }
    //详情页面
    public function show(Post $post)
    {
       return view('post/show',compact('post'));
    }
    //创建文章
    public function create()
    {
       return view('post/create');
    }
    //创建逻辑
    public function store()
    {
//        $post = new Post();
//        $post->title = request('title');
//        $post->content = request('content');
//        $post->save();

//        $params = ['title'=>request('title'),'content'=>request('content')];

        //验证
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        //逻辑

        $params = request(['title','content']);
        $res = Post::create($params);

        return redirect('/posts');
    }
    //编辑页面
    public function edit(Post $post)
    {
       return view('post/edit',compact('post'));
    }
    //编辑逻辑
    public function update(Post $post)
    {
        $this->validate(request(),[
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        return redirect("/posts/{$post->id}");
    }
    //删除页面
    public function delete()
    {
        
    }

    //上传图片
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }
}
