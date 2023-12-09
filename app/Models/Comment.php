<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'post_id', 'user_id'];

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
