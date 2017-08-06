<?php
namespace Admin\Controller;
class  AuthController extends CommonController
{
    public function index()
    {   $authModel=D('Auth');
        $authData=$authModel->getTree();
        $ccc=$authModel->count();
        $this->assign('ccc',$ccc);
        $this->assign('authData',$authData);
        $this->display();
    }
    public function add(){
        $authModel = D("Auth");
        if(IS_POST){
            //创建数据对象 并进行数据的验证
            if($authModel->create()){
                //入库插入数据
                if($authModel->add()){
                    //成功后面需要输出
                    $this->success("插入数据成功",U());die;
                }else{
                    $this->error("插入失败");
                }
            }else{
                //没有验证通过，输出没有验证通过的提示信息
                $this->error( $authModel->getError() );
            }
        }
        // 额外：取出所有的权限
        $authData = $authModel->getTree(); // getTree取出数据（使用递归处理）
        $this->assign('authData', $authData);
        $this->display();
    }
    public function del()
    {
        $authId = I('get.auth_id');
        $authModel = D("Auth");

        // 注意：之前说过，权限是存在层级，如果删除的某个权限存在子级权限，则不能删除
        // boolean true代表存在子级 false代表没有子级
        $status = $authModel->checkChild($authId);
        // 当前权限如果属于某一个角色，则不能删除
        if($status){
            $this->error('删除失败！ 当前权限存在子级，无法直接删除');
        }

        $authModel->delete($authId);

        $this->success('删除成功！',U('index'));exit();

    }
    public function upd(){
        $authModel = D("Auth");
        if(IS_POST){
            // 实例化模型接收数据
            if( $authModel->create() ){
                if($authModel->save() !== false){
                    $this->success('更新成功！');exit();
                }else{
                    $this->error('更新失败！' . $authModel->getDbError());
                }
            }else{
                $this->error('验证失败！' . $authModel->getError());
            }
        }
        $authId = I("get.auth_id");
        $authInfo = $authModel->find($authId);
        $this->assign('authInfo', $authInfo);

        $authData = $authModel->getTree();
        $this->assign('authData', $authData);

        // 获取当前权限的所有的子级主键ID 同时，还要包含自己
        $ids = $authModel->getChild($authId);
        $ids[] = $authId;
        $this->assign('ids', $ids);

        $this->display();
    }
}