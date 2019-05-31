<?php

namespace App\Http\Controllers\V1;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController{
    public function _response($status, $data = []){
        return response()->json([
            'status' => $status,
            'data' => $data
        ]);
    }

    public function _error($type = '', $message = ''){
        if ($type == '') $type = 'unknown_error';
        if ($type == 'unknown_error') $message = 'Неизвестная ошибка!';
        return $this->_response('error', ['type' => $type, 'message' => $message]);
    }
}
