<?php
namespace Admin\Controller;

class UserController extends CommonController {

    public function index(){
        //组装搜索条件
        $keyword = I('get.keyword');
        //不为空就组装查询条件
        if($keyword != ''){
            $where = array(
                'username' => array('like',"%{$keyword}%"),
            );
        }
        // 数据获取
        $userModel = D('User');
        // mysql> select a.*,b.role_name from sh_user a left join sh_role b on a.role_id = b.role_id\G
        $lists = $userModel
            ->alias('a')
            ->field('a.*,b.role_name')
            ->join(' left join role b on a.role_id = b.role_id')
            ->order('id ')
            ->where($where)
            ->select();
        $this->assign('lists', $lists);
        //2查出满足条件的总条数
        //統計賬號數量
        $con=$userModel->count();
        $this->assign('con',$con);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $UserModel = D("User");
            //创建数据对象 并进行数据的验证
            if($UserModel->create()){
                //入库插入数据
                if($UserModel->add()){
                    //成功后面需要输出
                    $this->success("插入数据成功",U());die;
                }else{
                    $this->error("插入失败".$UserModel->getDbError());
                }
            }else{
                //没有验证通过，输出没有验证通过的提示信息
                $this->error( '验证失败'.$UserModel->getError() );
            }

        }
//        1.为新增的账号添加角色信息
        $roleModel=D('Role');
        $roleData=$roleModel->select();
        $this->assign('roleData',$roleData);
        $this->display();
    }
    public function  del(){
        $UserModel = D("User");
        //主键为1的用户不能删除
        $u_id=I('get.id');
        if($u_id>1){
            $UserModel->delete($u_id);
            $this->success('删除成功',U('index'));exit;
        }else{
            $this->error('超级管理员不能删除');
        }
    }
    public function upd(){
        $UserModel = D("User");
        //用戶修改數據
        if(IS_POST){
            if($UserModel->create()){
                if($UserModel->save()!==false){
                    //成功后面需要输出
                    $this->success("修改数据成功");die;
                }else{
                    $this->error("修改失败".$UserModel->getDbError());
                }
            }else{
                //没有验证通过，输出没有验证通过的提示信息
                $this->error( '验证失败'.$UserModel->getError() );
            }
        }
        $id=I('get.id');
        $UserModel=D('User');
        $data=$UserModel->where("id=$id")->find();
        $roleModel=D('Role');
        $roleData=$roleModel->select();
        $this->assign('roleData',$roleData);
        $this->assign('data',$data);
        $this->display();
    }
}