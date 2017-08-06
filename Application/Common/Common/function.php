<?php
//封装一个无限极分类的方法
function getTree($data,$pid = 0,$level = 0){
    //定义一个静态的数组，后面递归调用自己的时候，此数组只会初始化一次
    static $lists = array();
    foreach ($data as $k => $v) {
        if($v['pid'] == $pid){ //先找到顶级 pid=0
            $v['level'] = $level; //给数组元素添加一个level的元素
            $lists[ $v['cat_id'] ] = $v; // 塞到$lists中去 也需要以cat_id作为下标
            getTree($data,$v['cat_id'],$level+1); //递归调用本身
        }
    }
    //返回数据
    return $lists;
}