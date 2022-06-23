<?php

namespace Baimo\Base\Http\Requests;

use Baimo\Core\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class PermissionStoreRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if($request->status == 1) {
            return [
                'name' => 'required|min:2',
                'icon' => 'required',
                'path' => 'required',
                'status'  => 'required|boolean',
                'method'  => 'required',
                'p_id'  => 'required',
                'hidden'  => 'required',

            ];
        } else{
            return [
                'name' => 'required|min:2',
                'url' => 'required',
                'method'  => 'required',
                'p_id'  => 'required',
                'hidden'  => 'required',
            ];
        }

    }
}
