<?php
namespace Admin\Model;

use Think\Model;

class  RoleModel extends Model
{
    /**
     * 插入的前置钩子将用户添加的角色对应的权限数组转换为字符串
     * @param  array &$data   角色权限数组
     * @param  array $options 模型添加
     */
    public function _before_insert(&$data, $options)
    {
        $data['role_id_list'] = implode(',', $data['role_id_list']); // [12, 23] --->12,23
    }
    /**
     * 更新的前置钩子将用户添加的角色对应的权限数组转换为字符串
     * @param  array &$data   角色权限数组
     * @param  array $options 模型添加
     */
    public function _before_update(&$data, $options)
    {
        $data['role_id_list'] = implode(',', $data['role_id_list']); // [12, 23] --->12,23
    }
}