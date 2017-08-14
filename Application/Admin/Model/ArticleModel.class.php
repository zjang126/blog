<?php
namespace Admin\Model;
use Think\Model;
class ArticleModel extends Model
{
    //定义自动验证
    protected $_validate = array(
        array("cat_id", 'selectCat', "请选择一个分类", 0, 'callback', 3),
    );
    //参数 pid是表单传进来的值
    public function selectCat($pid)
    {
        // return true验证通过
        // return false验证失败
        if ($pid == '0') {
            return false;
        }
        return true;
    }
    //回收站删除
    public function _before_delete($options)
    {
        $id = $options['where']['article_id'];
        $info = $this->field('img_url,thumb_url')->find($id);
        foreach ($info as $k => $v) {
            // 删除图片
            $path = C("UPLOAD_PATH") . $v;
            // 删除的时候 @ 错误抑制符
            @unlink($path);
        }
    }
    //新增加操作
    public function _before_insert(&$data, $options)
    {   $data['add_time']=time();
        // 封装一下：（添加上传、更新的时候也可能上传）
        // 上传的信息使用配置文件进行处理
        return $this->_uploadImg($data, $options);
        // _uploadImg这个函数的返回值是作为_before_insert返回值存在
    }


    
    
    
    
    
    public function _before_update(&$data, $options)
    {
        // 获取旧的图片的路径[如果有新图片上传则进行删除]
        if($_FILES['img']['error'] == 0){
            // 根本没有图片上传
            // 上传没有问题
            $id = $options['where']['article_id'];
            $info = $this->field('img_url,thumb_url')->find($id); // ['1.jpg', 'thumb_1.jpg']
            foreach ($info as $k => $v) {
                // 删除图片
                $path = C("UPLOAD_ROOT_PATH") . $v;
                @unlink($path);
            }
            // 获取新的上传图片的路径
            return $this->_uploadImg($data, $options);
        }
    }

    
    private function _uploadImg(&$data, $options)
    {
        $rootPath = C("UPLOAD_ROOT_PATH");
        $configFileSize = (int)C('UPLOAD_FILE_SIZE'); //3M 自己定义 intval(函数)
        $exts = C("UPLOAD_ALLOW_EXTS"); // 允许上传的后缀
        // 完成上传
        $config = array(
            'maxSize'    =>    $configFileSize * 1024 * 1024, //tp里面的单位单位是B(字节)8b  1Byte = 8bits  100Mbits / 8
            'rootPath'   =>    $rootPath, // 上传根目录（必须手工建立）
            'savePath'	 =>    'Article/', //上传的二级目录（不用自己建立）
            'saveName'   =>    array('uniqid',''),
            'exts'       =>    $exts,
        );
        // 实例化上传类
        $upload = new \Think\Upload($config);
        // 失败返回false，否则在返回一个数组
        $info = $upload->upload();
        if($info){
            // 上传图片的路径（二级目录）
            $url = $info['img']['savepath'] . $info['img']['savename'];
            $data['img_url'] = $url;
            // 缩略图地址（路径）
            $thumbName = $info['img']['savepath'] . 'thumb_'. $info['img']['savename'];
            $data['thumb_url'] = $thumbName;
            // 生成缩略图
            $image = new \Think\Image();
            $image->open($rootPath. $url );
            // 按照原图的比例生成一个最大为435*435的缩略图并保存为thumb.jpg
            $image->thumb(C('THUMB_CONFIG.W'), C('THUMB_CONFIG.H'), C('THUMB_CONFIG.S'))->save($rootPath . $thumbName);
            return true;
        }else{
            $error = $upload->getError(); // 获取上传失败的信息
            // 将错误赋值给模型的error属性，然后在控制器里面可以通过模型的getError()进行获取
            $this->error = $error;
            // $this->error('处理失败！'); // 控制器里面的方法 严重错误
            return false; // 终止插入
        }
    }
}