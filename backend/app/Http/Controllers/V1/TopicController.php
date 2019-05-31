<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Topic;
use Illuminate\Support\Facades\Gate;

class TopicController extends Controller {
    public function __construct(){

    }

    public function get(Request $request){
        $this->validate($request, [
            'take' => 'integer',
            'skip' => 'integer'
        ]);

        $take = $request->has('take') ? $request->get('take') : 10;
        $skip = $request->has('skip') ? $request->get('skip') : 0;

        return $this->_response('success', Topic::take($take)->skip($skip)->orderBy('id', 'desc')->get());
    }

    public function create(Request $request){
        $this->validate($request, [
            'title' => 'required|string|max:250'
        ]);

        if (Topic::where('title', $request->get('title'))->count() > 0) return $this->_response('topic_exists');
        
        $topic = new Topic;
        $topic->user_id = $request->user()->id;
        $topic->title = $request->get('title');
        if ($topic->save()) return $this->_response('success', $topic);

        return $this->_error();
    }

    public function update(Request $request){
        $this->validate($request, [
            'id' => 'required|integer',
            'title' => 'required|string|max:250'
        ]);

        $topic = Topic::find($request->get('id'));

        if ($topic == null) return $this->_response('topic_not_found');
        
        if (Gate::denies('update-topic', $topic)) return $this->_response('access_denied');
        
        $topic->title = $request->get('title');
        if ($topic->save()) return $this->_response('success', $topic);

        return $this->_error();
    }

    public function delete(Request $request){
        $this->validate($request, [
            'id' => 'required|integer'
        ]);

        $topic = Topic::find($request->get('id'));

        if ($topic == null) return $this->_response('topic_not_found');
        if (Gate::denies('delete-topic', $topic)) return $this->_response('access_denied');
        
        if ($topic->delete()) return $this->_response('success');

        return $this->_error();
    }
}
