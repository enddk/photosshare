<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use App\Http\Requests\addRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function index(){
        $items = DB::select('select * from post, users where post.user_id = users.id order by post_id desc');
        if (Auth::check()) {
           $data = [
            ['pass'=>'logout', 'icon'=>'fas fa-sign-out-alt', 'navi'=>'ログアウト'],
            ['pass'=>'add', 'icon'=>'fas fa-plus-square', 'navi'=>'投稿'],
            ['pass'=>'mypage', 'icon'=>'fas fa-user-circle', 'navi'=>'マイページ'],
           ];
        } else {
            $data = [
            ['pass'=>'login', 'icon'=>'fas fa-sign-in-alt', 'navi'=>'ログイン'],
            ['pass'=>'signin', 'icon'=>'fas fa-pen', 'navi'=>'サインイン'],
            ];
        }
            return view('photos.index', ['items' => $items], ['data' => $data]);
    }

    public function add(){
        return view('photos.add');
    }

    public function create(addRequest $request){
        $param = [
            'image' => $request->file('image')->getClientOriginalName(),
            'title' => $request->title,
            'text' => $request->text,
            'user' => $request->user,
        ];
        
        $request->file('image')->storeAs('',$param['image']);
        DB::insert('insert into post (image, title, text, user_id) values(:image, :title, :text, :user)', $param);
        return redirect('index');
    }

    public function view(Request $request){
        $param = ['id' => $request->id];
        $items = DB::select('select * from post, users where post_id = :id and post.user_id = users.id', $param);
        $count = DB::select('select * from likes where post_id = :id', $param);
        $comments = DB::select('select * from comment where post_id = :id', $param);
        $element = [
            'items' => $items,
            'likes' => $count,
            'comments' => $comments,
        ];
        return view('photos.view', $element);
    }

    public function login(Request $request){
        $data = [
            ['pass'=>'login', 'html'=> '<i class="fas fa-sign-in-alt"></i>
            <span>ログイン</span>'],
            ['pass'=>'signin', 'html'=> '<i class="fas fa-pen"></i>
            <span>サインイン</span>'],
        ];
        return view('photos.login',['data'=>$data]);
    }

    public function signin(Request $request){
        $data = [
            ['pass'=>'login', 'html'=> '<i class="fas fa-sign-in-alt"></i>
            <span>ログイン</span>'],
            ['pass'=>'signin', 'html'=> '<i class="fas fa-pen"></i>
            <span>サインイン</span>'],
        ];
        return view('photos.signin', ['data'=>$data]);
    }

    public function logup(Request $request){
        $mail = $request->mail;
        $password = $request->password;
        if(Auth::attempt(['email' => $mail,'password' => $password])){
            return redirect('index')->with('message', 'ログイン成功しました。');
        } else {
            return redirect()->back()->with('message', 'ログインに失敗しました。メールまたはパスワードが違います。');
        }
    }

    public function signup(loginRequest $request){
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'password' => $request->password,
        ];

        User::create([
            'name' => $request->name,
            'email' => $request->mail,
            'password' => Hash::make($request->password),
        ]);

        return redirect('index/login')->with('message', '登録しました。引き続きログインしてください。');
    }
    
    public function logout(){
        Auth::logout();
        return redirect('index')->with('message', 'ログアウトしました。');
    }

    public function mypage(){
        $param = [
            'id' => Auth::id(),
        ];
        $items = DB::select('select * from post, users where post.user_id = users.id AND users.id = :id order by id desc', $param);
        return view('photos.mypage', ['items' => $items]);
    }

    public function profile(Request $request){
        $param = [
            'id' => $request->id
        ];
        $items = DB::select('select * from post, users where post.user_id = users.id AND users.id = :id order by id desc', $param);
        $profile = DB::select('select * from users where id = :id', $param);
        return view('photos.viewprofile', ['items' => $items], ['profile' => $profile]);
    }

    public function edit(Request $request){
        $param = [
            'id' => Auth::user()->id,
        ];
        $items = DB::select('select * from users where id = :id', $param);
        return view('photos.edit', ['items' => $items]);
    }

    public function delete(Request $request){
        $param = ['id' => $request->post_id];
        DB::delete('delete from post where post_id = :id', $param);
        return redirect('index')->with('message','投稿を削除しました。');
    }

    public function update(Request $request){
        if($request->name == null || $request->mail == null){
            return back()->with('message', '名前またはメールアドレスが未入力です。');
        } else {
            $param = [
                'id' => Auth::id(),
                'name' => $request->name,
                'mail' => $request->mail,
            ];
    
            DB::update('update users set name = :name, email = :mail where id = :id',$param);
        
            return redirect('index/mypage');
        }
    }

    public function download(Request $request){
        return Storage::disk('')->download($request->filename);
    }

    public function comment(Request $request){
        $param = [
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user' => $request->user,
            'created_at' => now(),
        ];
        DB::insert('insert into comment (comment, post_id, user, created_at) values(:comment, :post_id, :user, :created_at)', $param);
        return back();
    }
}
