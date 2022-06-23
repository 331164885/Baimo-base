<?php

namespace Baimo\Base\Traits;

use Illuminate\Support\Facades\Log;

trait ToolsTrait
{
    /**
     * @param $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param int $root
     * @return array
     */
    public function get_tree($list, $pk = 'id', $pid = 'p_id', $child = 'children', $root = 0)
    {
        $tree = [];

        foreach ($list as $key => $val) {

            if ($val[$pid] == $root) {
                //获取当前$pid所有子类
                unset($list[$key]);

                if (!empty($list)) {
                    $child = $this->get_tree($list, $pk, $pid, $child, $val[$pk]);
                    if (!empty($child)) {
                        $val['children'] = $child;
                    }
                }
                $tree[] = $val;
            }
        }
        return $tree;
    }
}