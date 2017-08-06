<?php
namespace Admin\Controller;
class CategoryController extends CommonController{
    public function index(){
        //组装搜索条件
        $keyword = I('get.cat_name');
        //不为空就组装查询条件
        if($keyword != ''){
            $where = array(
                'cat_name' => array('like',"%{$keyword}%"),
            );
        }
        $catModel = D("Category");
        //不联表方法(以主键cat_id的值作为下标)
        $lists = $catModel->where($where )->select(array("index"=>"cat_id"));
        $con=$catModel->count();
        $lists = getTree($lists);
        $this->assign('con',$con);
        $this->assign('lists',$lists);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $catModel = D("Category");
            //创建数据对象 并进行数据的验证
            if($catModel->create()){
                //入库插入数据
                if($catModel->add()){
                    //成功后面需要输出
                    $this->success("插入数据成功",U());die();
                }else{
                    $this->error("插入失败");
                }
            }else{
                //没有验证通过，输出没有验证通过的提示信息
                $this->error( $catModel->getError() );
            }

        }
        //取出所有的分类
        $cats = D("Category")->select();
        //无限极分类处理
        $cats = getTree($cats);
        $this->assign("cats",$cats);
        $this->display();
    }

    public function upd(){
        $catModel = D("Category");
        //完成编辑post请求
        if(IS_POST){
            if($catModel->create()){
                //验证成功修改数据
                if($catModel->save()){
                    //编辑成功
                    $this->success("编辑成功",U());die();
                }else{
                    //编辑失败
                    $this->error("编辑失败".$catModel->getError());
                }
            }else{
                $this->error($catModel->getError());
            }
        }


        $cat_id = I("get.cat_id");
        //获取当前分类的子分类
        $childIds = $catModel->getChildIds($cat_id);
        $childIds[] = $cat_id; //把当前分类也就加进去

        $this->assign("childIds",$childIds);
        $data = $catModel->find($cat_id);
        //获取所有的分类（有层级关系的分类）
        $cats = getTree( $catModel->Select() );
        $this->assign("cats",$cats);

        $this->assign("data",$data);
        $this->display();
    }
    //删除分类的方法
    public function del(){
        if(IS_AJAX){
            $cat_id = I('get.cat_id');
            $catModel = D("Category");
            //判断当前分类下面有没有子分类
            $flag1 = $catModel->checkChild($cat_id);
            if($flag1){
                $data = array(
                    'errCode' =>1 ,
                    'info'=>'当前栏目下面有子分类，不能删除'
                );
                echo json_encode($data);die();
            }
            //判断当前分类有没有文章
            $flag2 = $catModel->checkArticle($cat_id);
            if($flag2){
                $data = array(
                    'errCode' =>2 ,
                    'info'=>'当前栏目下面有文章，不能删除'
                );
                echo json_encode($data);die();
            }

            //删除文章分类
            $catModel->delete($cat_id);
            echo json_encode(array('errCode'=>0,'info'=>"删除成功"));die();
        }
    }






}