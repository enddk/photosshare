<?php

namespace App\Http\Controllers;

use App\Models\like;
use Illuminate\Http\Request;

class LikeController extends Controller
{    
    public function index(Request $request){
        $items = like::all();
        return view('like.index', ['items' => $items]);
    }

   public function get(Request $request){
    $like = new like;
    $like->post_id = $request->post_id;
    $like->user_id = $request->user_id;
    
    $tmp = $like->where('post_id', $request->post_id)->where('user_id', $request->user_id)->get();
    
    if($tmp->isEmpty()){
         $res = false;
     } else {
         $res = true;
     }

    return response()->json(['res' => $res]);
   }

   public function add(Request $request){
       $like = new like;
       $like->post_id = $request->post_id;
       $like->user_id = $request->user_id;
       
       $tmp = $like->where('post_id', $request->post_id)->where('user_id', $request->user_id)->get();
       
       if($tmp->isEmpty()){
           $like->save();
           $res = true;
        } else {
            $like->where('post_id', $request->post_id)->where('user_id', $request->user_id)->delete();
            $res = false;
        }

       return response()->json(['res' => $res]);
   }

   public function count(Request $request){
       $count = like::all();
       return $count->where('post_id', $request->post_id)->count();
   }


}