<?php
namespace Admin\Controller;


class  RoleController extends CommonController
{
    public function add(){
        if(IS_POST){
            $roleModel = D("Role");
            //创建数据对象 并进行数据的验证
            if($roleModel->create()){
                //入库插入数据
                if($roleModel->add()){
                    //成功后面需要输出
                    $this->success("插入数据成功");die;
                }else{
                    $this->error("插入失败");
                }
            }else{
                //没有验证通过，输出没有验证通过的提示信息
                // $this->error( $roleModel->getError() );
                $error=$roleModel->getError();
                $this->error($error);
            }
        }
        $authModel=D('Auth');
        $authData=$authModel->getTree();
        $this->assign('authData',$authData);
        $this->display();
    }
    public function index(){
        //获得角色对应的权限数据
        $roleModel=D('Role');
        //获得角色对应的权限数据
        //原生处理
        //$sql="select a.*,group_concat(b.auth_name) as auth_name from role a left join auth b on
        //find_in_set(b.auth_id,a.role_id_list)group by a.role_id";
        //M('Role')->query($sql);

        //将上面的sql转化为链式操作
        $ccc=$roleModel->count();
        $roleData=$roleModel
            ->alias('a')
            ->field('a.*,group_concat(b.auth_name) as auth_name')
            ->join('left join auth b on find_in_set(b.auth_id , a.role_id_list)')
            ->group('a.role_id')
            ->select();
        $this->assign('roleData',$roleData);
        $this->assign('ccc',$ccc);
        $this->display();
    }
    public function upd(){
        $roleModel = D("Role");
        if(IS_POST){
            //创建数据对象 并进行数据的验证
            if($roleModel->create()){
                //入库插入数据
                if($roleModel->save()!==false){
                    //成功后面需要输出
                    $this->success("插入数据成功");die();
                }else{
                    $this->error("插入失败".$roleModel->getError());
                }
            }else{
                //没有验证通过，输出没有验证通过的提示信息
                $this->error( $roleModel->getError() );
            }
        }
        $roleId=I('get.role_id');
        $roleInfo=$roleModel->find($roleId);
        $this->assign('roleInfo',$roleInfo);
        //权限
        $authModel=D('Auth');
        $authData=$authModel->getTree();
        $this->assign('authData',$authData);
        $this->display();
    }
    public function del(){
        if(IS_AJAX){
            $r_id = I('get.r_id');
            $Model = D("Role");
            //删除文章分类
            $Model->delete($r_id);
            echo json_encode(array('errCode'=>0,'info'=>"删除成功"));die();
        }
    }

}