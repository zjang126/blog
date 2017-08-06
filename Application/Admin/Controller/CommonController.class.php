<?php
namespace Admin\Controller;

use Think\Controller;

class  CommonController extends Controller
{
    public function _initialize()
    {
        if(!session('?id')){
            $this->error('请先登录后再访问',U('Login/login'));
        }
//       3.权限的验证
//        注意: 1.超级管理员 2.公共的权限
        //建议:把公共的权限放置在一个配置文件的数组里面
//        C('public_auth') array_merge (C('public_auth'),$allowAuth)
//        认为后台的index控制器下的方法都是公共的
        if(CONTROLLER_NAME=='index'){
            return true;
        }
        //注意:如果获取当前用户的访问的操作(权限信息)
        $currentAction=CONTROLLER_NAME.'/'.ACTION_NAME; //USER/LST
        //代表用户所拥有的权限


        $allowAuth=session('auth');

        //代表不是超级管理员,当前访问操作是否 在用户的权限列表里面 //strtolower 规范大小写
        if($allowAuth!='*' &&  !in_array(strtolower($currentAction),$allowAuth)){
            $this->error('无权限访问',U('Index/index'));
    }
    }
}