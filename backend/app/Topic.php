<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Topic extends Model {
    protected $fillable = [
        'title',
    ];

    protected $appends = [
    	'user', 'postsCount'
    ];

    public function getUserAttribute(){
    	return User::find($this->attributes['user_id']);
    }

    public function posts(){
    	return $this->hasMany('\App\Post');
    }

    public function getPostsCountAttribute(){
        return \App\Post::where('topic_id', $this->attributes['id'])->count();
    }
}
