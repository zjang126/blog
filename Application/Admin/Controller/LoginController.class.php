<?php
namespace Admin\Controller;

use Think\Controller;

class  LoginController extends Controller
{
  public function login(){
    // 登录验证
    if( IS_POST ){
        $userModel = D("User");
        // 验证后创建数据对象 处理： 在TP看到是一个添加的过程 除非表单里面存在主键ID（更新） 或者是我们自定义create的第二个参数 4 代表是登录的处理
        if( $userModel->create( I('post.'), 4) ){
            // 用户名和密码的合理性
            $status = $userModel->login();
            // true 代表成功 1代表用户不存在 2代表是密码错误
            if($status === true){
                $this->success('登录成功！', U('User/index'));exit();
            }else{
                // 实际： 用户名或者密码错误！！！
                if($status == 1){
                    $this->error('用户名不存在！');
                }else{
                    $this->error('密码错误！');
                }
            }

        }else{
            $this->error('验证失败！' . $userModel->getError() );
        }
    }
    // 登录页面
    $this->display();
}
    public function  genCode(){
        //实例化验证码类
        //验证码的基本设置
        $config=array(
            'useImgBg'  =>  false,           // 使用背景图片
            'fontSize'  =>  15,              // 验证码字体大小(px)
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'imageH'    =>  '40',               // 验证码图片高度
            'imageW'    =>  '120',               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '',              // 验证码字体，不设置随机获取
            'bg'        =>  array(243, 251, 254),  // 背景颜色
            'reset'     =>  true,           // 验证成功后是否重置
            'codeSet'   =>  '0123456789',             // 验证码字符集合
            'expire'    =>  1800,            // 验证码过期时间（s）
        );
        $Verify= new \Think\Verify($config);
        //輸出驗證碼
        $Verify->entry();
    }
    public function logout()
    {
        session(null);
        $this->success('退出成功！', U('Login/login'));exit();
    }
}