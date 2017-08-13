<?php
namespace Admin\Model;
use Think\Model;
class ArticleModel extends Model{
    //定义自动验证
    protected $_validate=array(
        array("cat_id",'selectCat',"请选择一个分类",0,'callback',3),
    );
    //参数 pid是表单传进来的值
    public function selectCat($pid){
        // return true验证通过
        // return false验证失败
        if($pid == '0'){
            return false;
        }
        return true;
    }
    // 插入数据前的回调方法
    protected function _before_insert(&$data,$options) {
        $data['add_time'] = time();
        //判断用户有没有文件上传
        if($_FILES['img']['error'] == 0){
            //开始上传文件
            $uploadinfo = $this->fileUpload();
            if($uploadinfo == false){
                return false; // 返回 false 不会入库 必须加return
            }else{
                //写入路径到$data中去，方便入库操作
                $data['img_url'] = $uploadinfo['img']['savepath'].$uploadinfo['img']['savename'];

                $thumb_url = $uploadinfo['img']['savepath']."thumb_".$uploadinfo['img']['savename'];
                //进行缩略图处理
                $image = new \Think\Image();
                //打开一个图片的路径
                $image->open(C("UPLOAD_PATH").$data['img_url']);
                // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                $image->thumb(150, 150,1)->save(C("UPLOAD_PATH").$thumb_url); // ./相对于入口文件index.php
                //把缩略图的路径写入数据库
                $data['thumb_url'] = $thumb_url;
            }
        }
    }

    //定义一个上传文件的方法
    public function fileUpload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小   3M
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     C('UPLOAD_PATH'); // 设置附件上传目录
        //判断是否是目录，不是则创建
        if(!is_dir($upload->rootPath) ){
            mkdir($upload->rootPath);
        }
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {
            //获取到上传文件的错误信息
            //把错误的信息赋值给当前模型对象的error属性，error属性不为空则说明没有验证通过
            $this->error = $upload->getError();
            return false;
        }else{
            // 上传成功   返回上传成功的信息
            return $info;

        }
    }
//图片不上传默认不作处理
    protected function _before_update(&$data,$options)
    {
        // 获取旧的图片的路径[如果有新图片上传则进行删除]
        if($_FILES['goods_img']['error'] == 0) {
            // 根本没有图片上传
            // 上传没有问题
            $Id = $data['article_id'];
            $info = $this->field('img_url,thumb_url')->find($Id); // ['1.jpg', 'thumb_1.jpg']
            foreach ($info as $k => $v) {
                // 删除图片
                $path = C("UPLOAD_ROOT_PATH") . $v;
                @unlink($path);
            }
            // 获取新的上传图片的路径
            return $this->fileUpload();
        }
    }
}