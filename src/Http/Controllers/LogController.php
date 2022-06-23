<?php

namespace Baimo\Base\Http\Controllers;

use Baimo\Core\Http\Controllers\BaseApiController as Controller;
use Baimo\Base\Models\AdminLog;
use Casbin\Log\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page',1);
        $limit = $request->get('limit',10);
        $query = AdminLog::query();
        $total = $query->count();
        $list = $query->forPage($page,$limit)->get([ 'url','ip','method','name','u_id','created_at','address','id']);


        return $this->success(
            [
                'list' => $list,
                'mate'=>[
                    'total' => $total,
                    'pageSize'=>$limit
                ]
            ]
        );

    }
    public function destroy(Request $request)
    {
        $request->validate([
            'id'=>'required'
        ]);
        AdminLog::query()->whereIn('id',explode(',',$request->id))->delete();
        return $this->success($request->id);
    }
}
