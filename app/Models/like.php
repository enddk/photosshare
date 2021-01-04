<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    use HasFactory;

    protected $guarded = array('id','created_at','updated_at');

    public function getCount(){
        return $this->where('post_id', $request->post_id)->count();
    }
}
