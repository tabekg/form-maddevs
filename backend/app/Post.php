<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model {
    protected $fillable = [
        'text',
    ];

    protected $appends = [
    	'user'
    ];

    public function getUserAttribute(){
    		return User::find($this->attributes['user_id']);
    }
}
