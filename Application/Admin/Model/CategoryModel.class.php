<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model{
    //定义自动验证
    protected $_validate = array(
        //array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]),
        array('cat_name','','栏目名称重复',0,'unique',2),
    );
    // 更新数据前的回调方法
    protected function _before_insert(&$data,$options) {
        $data['add_time'] = time();
    }
    //检查当前分类下面有没有子分类
    public function checkChild($cat_id){
        return $this->where( "pid = ".$cat_id )->find();
    }
    //检查当前分类下面有没有文章
    public function checkArticle($cat_id){
        return D("Article")->where( "cat_id = ".$cat_id )->find();
    }
    /**
     * 获取当前分类的子分类的id
     * @param  int $cat_id 分类的id
     * @return array    返回子分类的id
     */
    public function getChildIds($cat_id){
        $data = $this->select();
        //一般方法前有下划线都是私有
        return $this->_getChildIds($data,$cat_id);
    }



    private function _getChildIds($data,$cat_id){
        static $childIds = array();
        foreach ($data as $k => $v) {
            if($v['pid'] == $cat_id){
                //找到子分类id塞到childIds数组中去
                $childIds[] = $v['cat_id'];
                $this->_getChildIds($data,$v['cat_id']);
            }
        }
        //返回所有子分类的id
        return $childIds;
    }



}