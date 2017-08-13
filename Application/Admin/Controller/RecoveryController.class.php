<?php
namespace Admin\Controller;
use Think\Controller;
class  RecoveryController extends Controller
{
    public function index(){
        $articleModel=D('Article');
        //分页实现
        //1.查询出满足条件的总记录数
        $count = $articleModel->where('is_delete=1')->join("t1 left join category t2 on t1.cat_id = t2.cat_id")->count();
        //2、实例化分页类 传递总记录数和每页显示条数
        $page = new \Think\Page($count,2);
        //修改分页的样式
        $page->setConfig("prev","上一页");
        $page->setConfig("next","下一页");
        //3、获取分页的列码
        $pageList = $page->show();
        //4、组装分页的limit语句
        $ArticleData = $articleModel
            ->field("t1.*,t2.cat_name")
            ->where('is_delete=1')
            ->join("t1 left join category t2 on t1.cat_id = t2.cat_id")
            ->order("t1.article_id desc")
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        //5、分配页码和数据
        $this->assign('count',$count);
        $this->assign('pageList',$pageList);
        $this->assign('ArticleData',$ArticleData);
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
    public function del(){
        if(IS_AJAX){
            $article_id = I('get.article_id');
            $articleModel = D("Article");
            //删除文章分类
            $flog=$articleModel->delete($article_id);
            //添加进回收站,做伪删除
            if($flog){
                $data=array(
                    'errCode'=>0,
                    'info'=>'删除成功',
                );
                echo json_encode($data);die();
            }
        }
    }
    public function reback(){
        if(IS_AJAX){
            $a_id = I('get.a_id');
            $articleModel = D("Article");
            //删除文章分类
            $flog=$articleModel->where(array('article_id'=>$a_id))->setField('is_delete',0);
            //添加进回收站,做伪删除
            if($flog){
                $data=array(
                    'errCode'=>0,
                    'info'=>'博文复原成功',
                );
                echo json_encode($data);die();
            }
        }
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
}