<?php
namespace Admin\Model;

use Think\Model;

class  UserModel extends Model
{
    //自动验证
    protected  $_validate =array(
        //唯一性验证
//        array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
        array('captcha', '_checkCode', '验证码不正确', 1, 'callback', 4),
        array('username','','帐号名称已经存在！',1,'unique',1),
        array('username','','帐号名称已经存在！',1,'unique',2),
        array('email','email','邮箱重复',1,'unique',1),
        array('email','email','邮箱重复',1,'unique',2),
        array('phone','','手机号已经存在！',1,'unique',1),


    );
    protected  $_auto=array(
        array('add_time','time',1,'function'),
    );



//利用钩子对密码进行加密   规则：md5( md5('用户提交的密码') + 盐(随机字符串 uniqid()) );
    public  function  _before_insert(&$data, $options)
    {

        $salt=uniqid();
        $data['salt']=$salt;
        $data['password']=md5(md5($data['password']).$salt);


    }
    //不同的擦做方法使用的钩子不同
    public function _before_update(&$data, $options)
    {
        if($data['password']){
            $salt=uniqid();
            $data['salt']=$salt;
            $data['password']=md5(md5($data['password']).$salt);
        }else{
            unset($data['password']);
        }

    }
    protected function _checkCode($code)
    {
        $verify = new \Think\Verify();
        return $verify->check($code, '');
    }
    public function login()
    {
        // 规定 $username = I('post.username');
        // 为什么可以？ 面向对象 ---> 父类--> model.class.php --> 魔术方法__get()
        $username = $this->username;
        $password = $this->password;

        $where = array('username' => $username);
        $info = $this->where($where)->find();
        $salt = $info['salt'];

        if ($info) {
            // 合法
            if (md5(md5($password) . $salt)  == $info['password']) {
                //1 登录成功 记录标识
                session('id', $info['id']); // TP里面提供的
                session('username', $info['username']);
                session('adminRole',$info['adminRole']);//记录数据渲染页面
                cookie('username', $info['username'],3600);
                //2更新用户信息
                $this->_updateUserInfo($info['id']);
                //3查询用户对应的权限信息
                $this->_putAuthAndMenuToSessionByRoleId($info['role_id']);
                return true;
            } else {
                return 2; //密码错误
            }
        } else {
            // 用户不存在
            return 1;
        }
    }
    private  function  _updateUserInfo($userId){
        //更新登录时间.ip
        $data=array(
            'id'=>$userId,
            'log_time'=>time(),                  //$_SEVER['REMETO_ADDR']代表客户端ip地址:获取ip地址
            'login_ip'=>ip2long(get_client_ip()),//get_client_ip是tp提供的一个函数,functions.phg 点分式的ip地址
        );
        $this->save($data);
    }   //sava可以接受数据的直接更新,但必须存在主键 ,没主键要加上更新条件

    private function _putAuthAndMenuToSessionByRoleId($roleId)
    {
        // 1. 根据角色ID查询role_id_list（权限ID字符串）
        $authModel = D("Auth");
        $roleModel = D("Role");
        $info = $roleModel->field('role_id_list')->find($roleId); // 注意：role_id_list *
        if( $info['role_id_list'] == '*' ){
            // 超级管理员 拥有所有的权限
            session('auth', '*');
            // 超级管理员的权限菜单应该是不受限制 后台左侧的菜单一般只显示两级菜单
            // 顶级菜单 auth_pid = 0
            $menu = $authModel->where('auth_pid = 0')->select();  // [['auth_id' => 1, 'auth_pid' => 0, 'sub' => [[],[]]],[]]
            // 顶级下面的二级权限
            foreach ($menu as $k => $v) {
                // 二级 条件 放：对应的顶级菜单对应的这项里面
                $menu[$k]['sub'] = $authModel->where("auth_pid = " . $v['auth_id'])->select();

            }
            session('menu', $menu);

        }else{
            // 普通角色 存在对应的权限 $info['role_id_list'];
            // 数据：二维数组 到时候做权限的验证  in_array( CONTROLLER_NAME .'/'. ACTION_NAME, 用户的权限一维数组)
            $_authData = $authModel->field('auth_id,auth_name,auth_c,auth_a, concat(auth_c,"/", auth_a) as url ,auth_pid')->where("auth_id in (" . $info['role_id_list'] . ")")->select();
            $menu = array();
            // 转换：
            $authData = array();
            foreach ($_authData as $k => $v) {
                // 顶级权限
                if($v['auth_pid'] == 0){
                    $menu[] = $v;
                }
                $authData[] = $v['url']; // ['User/lst', 'User/add', 'Order/add'];
            }
            // 二级权限信息
            foreach ($menu as $k => $v) {
                foreach ($_authData as $key => $value) {
                    if($value['auth_pid'] == $v['auth_id']){
                        // 每一个顶级权限可能存在多个子级
                        $menu[$k]['sub'][] = $value;
                    }
                }
            }
            // 保存起来
            session('auth', $authData);
            session('menu', $menu);
        }
    }

}