<?php

namespace Baimo\Base\Service;

use Illuminate\Support\Facades\Http;

class TaskService
{
    public function add($id,$cycle,$textarea)
    {
        $url = env('CRON_HOST')."/api/addJob";
        $resp = Http::post($url,[
            'id'=>$id,
            'cycle'=>$cycle,
            'textarea'=>$textarea,
        ]);
        if($resp->ok()) {
            return true;
        }
        return  false;
    }
    public function delete($id)
    {
        $url = env('CRON_HOST')."/api/addJob";
        $resp = Http::delete($url,[
            'id'=>$id]);
        if($resp->ok()) {
            return true;
        }
        return  false;
    }


}
