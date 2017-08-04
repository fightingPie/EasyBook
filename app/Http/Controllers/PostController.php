<?php

namespace App\Http\Controllers;

//use App\Post;
use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //列表页面
    public function index()
    {
//        echo 123;exit();
        $posts = Post::orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(6);
//        dd($posts);
        return view("post/index",compact('posts'));
    }
    //详情页面
    public function show(Post $post)
    {
//        dd($post::with('comments')->get());
        $post->load("comments");
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
        $user_id = \Auth::id();
        $params = array_merge(request(['title','content']),compact('user_id'));
//        $params = request(['title','content']);
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

        $this->authorize('update',$post);

        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        return redirect("/posts/{$post->id}");
    }
    //删除页面
    public function delete(Post $post)
    {

        //TODO:用户的权限
        $this->authorize('delete',$post);

        $post->delete();

        return redirect("/posts");
    }

    //上传图片
    public function imageUpload(Request $request)
    {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
    }

    public function  comment(Post $post)
    {
        $this->validate(request(),[
            'content' => 'required|min:3',
        ]);

        //
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);


        return  back();
    }

    //赞
    public function zan(Post $post)
    {
        $param = [
            'user_id'=> \Auth::id(),
            'post_id' => $post->id
        ];
        Zan::firstOrCreate($param);

        return back();
    }

    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
        return back();
    }
}
