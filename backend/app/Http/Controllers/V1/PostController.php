<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Post;
use App\Topic;

class PostController extends Controller {
    public function __construct(){

    }

    public function get(Request $request){
        $this->validate($request, [
            'topic' => 'required|integer',
            'take' => 'integer',
            'skip' => 'integer'
        ]);

        $topic = Topic::find($request->get('topic'));

        if ($topic == null) return $this->_response('topic_not_found');

        $take = $request->has('take') ? $request->get('take') : 10;
        $skip = $request->has('skip') ? $request->get('skip') : 0;

        return $topic->posts()->take($take)->skip($skip)->orderBy('id', 'desc')->get();
    }

    public function create(Request $request){
        $this->validate($request, [
            'topic' => 'required|integer',
            'text' => 'required|string|max:10000'
        ]);

        if (Topic::find($request->get('topic')) == null) return $this->_response('topic_not_found');
        if (Post::where('topic_id', $request->get('topic'))->where('text', $request->get('text'))->count() > 0) return $this->_response('post_exists');
        
        $post = new Post;
        $post->user_id = $request->user()->id;
        $post->topic_id = $request->get('topic');
        $post->text = $request->get('text');
        if ($post->save()) return $this->_response('success', $post);

        return $this->_error();
    }

    public function update(Request $request){
        $this->validate($request, [
            'id' => 'required|integer',
            'text' => 'required|string|max:10000'
        ]);

        $post = Post::find($request->get('id'));

        if ($post == null) return $this->_response('post_not_found');
        if (Gate::denies('update-post', $post)) return $this->_response('access_denied');
        
        $post->text = $request->get('text');
        if ($post->save()) return $this->_response('success', $post);

        return $this->_error();
    }

    public function delete(Request $request){
        $this->validate($request, [
            'id' => 'required|integer'
        ]);

        $post = Post::find($request->get('id'));

        if ($post == null) return $this->_response('post_not_found');
        if (Gate::denies('delete-post', $post)) return $this->_response('access_denied');
        
        if ($post->delete()) return $this->_response('success');

        return $this->_error();
    }
}
