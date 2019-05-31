<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Topic extends Model {
    protected $fillable = [
        'title',
    ];

    protected $appends = [
    	'user'
    ];

    public function getUserAttribute(){
    		return User::find($this->attributes['user_id']);
    }
}
