<?php
namespace Admin\Model;

use Think\Model;

class  AuthModel extends Model
{
    //自动验证
    protected $_validate=array(
        array('auth_pid','require','权限上级id不能为空'),
        array('auth_a','require','权限方法不能为空'),
        array('auth_c','require','权限控制器不能为空'),
    );
    //使用递归来获取层级关系的权限数据
    public function getTree(){
        $data=$this->select();
        return $this->_getTree($data);
    }
    //递归处理数据
    public  function _getTree($data,$pid=0,$level=0){
        //递归处理数据
        static $list=array();
        foreach ($data as $k=>$v) {
            if($v['auth_pid']==$pid){
                $v['level']=$level;
                $list[]=$v;
                $this->_getTree($data,$v['auth_id'],$level+1);
            }
        }
        return $list;
    }
    public function checkChild($auth_id){
        $where=array('auth_pid'=>$auth_id);
        return $this->where($where)->find(); //这个的逻辑是找到一个都不要删除,用find可以减少内存
    }
    public function getChild($authId)
    {
        $data = $this->select();
        return $this->_getChild($data, $authId);
    }
    public function _getChild($data, $authId)
    {
        static $list = array();
        foreach ($data as $k => $v) {
            if($v['auth_pid'] == $authId){
                $list[] = $v['auth_id'];
                $this->_getChild($data, $v['auth_id']);
            }
        }
        return $list;
    }
}