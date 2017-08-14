<?php
namespace Admin\Controller;  //定义控制器的命名空间
class ArticleController extends CommonController {

    public function index(){
        //组装搜索条件
        $keyword = I('get.keyword');
        //不为空就组装查询条件
        if($keyword != ''){
            $where = array(
                'title' => array('like',"%{$keyword}%"),
                'is_delete'=>0,
            );
        }else{
           $where=array('is_delete'=>0);
        }
        $articleModel =  D("Article");
        //分页实现
        //1.查询出满足条件的总记录数
        $count = $articleModel->where($where)->join("t1 left join category t2 on t1.cat_id = t2.cat_id")->count();
        //2、实例化分页类 传递总记录数和每页显示条数
        $page = new \Think\Page($count,7);
        //修改分页的样式
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        //3、获取分页的列码
        $pageList = $page->show();
        //dump($pageList);die;
        //4、组装分页的limit语句
        $lists = $articleModel
            ->field("t1.*,t2.cat_name")
            ->where($where)
            ->join("t1 left join category t2 on t1.cat_id = t2.cat_id")
            ->order("t1.article_id desc")
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        //5、分配页码和数据
        $this->assign('count',$count);
        $this->assign('pageList',$pageList);
        $this->assign('lists',$lists);
        //判断请求的类型
        if(IS_AJAX){
            //获取分页的主体和分页的页码数据
            $content = array(
                'page'=>$pageList,   //分页页码数据
                'data'=>$this->fetch('public:data'), //分页的主体数据 fetch底层是return
            );
            echo json_encode($content);die();
        }
        $this->display(); //这块是给get请求的 display底层是echo
    }
    public function add(){
        $articleModel = D("Article");
        if(IS_POST){
            if($articleModel->create()){
                if($articleModel->add()){
                    $this->success("添加成功",U());die();
                }else{
                    $this->error('添加失败'.$articleModel->getError());
                }
            }else{
                //验证失败
                $this->error($articleModel->getError());
            }
        }
        //取出文章分类(层级关系)
        $this->cats = getTree( D("Category")->select() );
        $this->display();
    }
    //ajax获取文章的详情
    public function ajaxGetContent(){
        if(IS_AJAX){
            $article_id = I('get.article_id');
            $row = D("Article")->find($article_id);
            $data = array(
                //需要把html实体符号转化为html标签
                //&gt   >
                'content' => htmlspecialchars_decode($row['content'])
            );
            echo json_encode($data);die;
        }
    }
    //完成文章分类的文章数量统计
    public function charts(){
        //统计每个分类下面的文章的总数量
        $data = D("Article")
            ->field(" count(t1.cat_id) total ,t2.cat_name ")
            ->join("t1 left join category t2 on t1.cat_id = t2.cat_id ")
            ->group("t1.cat_id")
            ->select();
        //把$data变为json格式的数据 分配到模板中，更方便js操作数据
        $this->assign("data",json_encode($data) );
        $this->display();
    }
    //ajax无刷新进回收站的方法
    public function del(){
        if(IS_AJAX){
            $article_id = I('get.article_id');
            $articleModel = M("Article");
            //删除文章分类
            $flog=$articleModel->where(array('article_id'=>$article_id))->setField('is_delete',1);
            //添加进回收站,做伪删除
            if($flog){
                $data=array(
                    'errCode'=>0,
                    'info'=>'成功添加回收站',
                );
                echo json_encode($data);die();
            }
        }
    }
    //文章编辑
    public function upd(){
        $articleModel = D("Article");
        //用戶修改數據
        if(IS_POST){
            if($articleModel->create()){
                if($articleModel->save()!==false){
                    //成功后面需要输出
                    $this->success("修改数据成功");die();
                }else{
                    $this->error("修改失败".$articleModel->getError());
                }
            }else{
                //没有验证通过，输出没有验证通过的提示信息
                $this->error( '验证失败'.$articleModel->getError() );
            }
        }
        $id=I('get.a_id');
        $articleModel=D('Article');
        $data=$articleModel->where("article_id=$id")->find();
        $cat_id = $data['cat_id'];
        $this->assign('data',$data);
        $catModel=D('Category');
        //获取当前分类的子分类
        $childIds = $catModel->getChildIds($cat_id);
        $childIds[] = $cat_id; //把当前分类也就加进去
        $this->assign("childIds",$childIds);
        //获取所有的分类（有层级关系的分类）
        $cats = getTree( $catModel->Select() );
        $this->assign("cats",$cats);
        $this->display();
    }
}