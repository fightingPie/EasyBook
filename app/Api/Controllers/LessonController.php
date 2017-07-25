<?php
/**
 * Created by PhpStorm.
 * User: phuang
 * Date: 2017/7/21
 * Time: 15:36
 */

namespace App\Api\Controllers;


use App\Api\Transformers\LessonTransformer;
use App\Lesson;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class LessonController extends BaseController
{
    public function index()
    {
        $lesson = Lesson::all();

        $users = Lesson::paginate(25);
        $arr = ['status'=>200,'mes'=>''];
        return $this->response->paginator($users,new LessonTransformer())->setMeta($arr);
//        return $this->response->collection($lesson , new LessonTransformer())->meta('status', '200')->addMeta('ss','');

    }

    public function register(Request $request) {
        $newUser = [
            'email' => $request->get('email'),
            'name' => $request->get('name'),
            'password' => bcrypt($request->get('password'))
        ];

        $user = User::create($newUser);
        $token = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }
}