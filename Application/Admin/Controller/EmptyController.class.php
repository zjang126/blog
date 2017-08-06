<?php
namespace Admin\Controller;



class  EmptyController extends CommonController
{
    public function _empty()
    {
       $this->error('很抱歉,你要访问的页面不存在!');
    }
}