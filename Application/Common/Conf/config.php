<?php
return array(
    //'配置项'=>'配置值'
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'bobo',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀

    'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Login', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'login', // 默认操作名称

    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'TMPL_PARSE_STRING'  =>array(
        'ADMIN_PUBLIC' => '/Public/Admin',
        'HOME_PUBLIC' => '/Public/Home',
        "VIEW_UPLOAD" => "/Public/Uploads",//上传图片地址
    ) ,
    'TMPL_L_DELIM' => '{{', // 模板引擎普通标签开始标记
    'TMPL_R_DELIM' => '}}', // 模板引擎普通标签结束标记
    'URL_PARAMS_BIND'       =>  true, // URL变量绑定到操作方法作为参数
//    开启页面trace调试
    'SHOW_PAGE_TRACE'=>true,
    // 关闭字段缓存
    'DB_FIELDS_CACHE'=>false,
    // 上传处理
    'UPLOAD_ROOT_PATH'     => './Public/Uploads/', // 注意： 1. 前面有点（相对于index.php TP单一入口的） 2. 后面有些斜线
    'UPLOAD_FILE_SIZE'     => '3M', // 单位M
    'UPLOAD_ALLOW_EXTS'    => array('jpg', 'gif', 'png', 'jpeg'), // 允许上传的后缀
    // 缩略图配置
    'THUMB_CONFIG'  => array(
        'W' => 350,
        'H' => 350,
        'S' => 6 // 按照固定尺寸生成缩略图
    ),
    // 显示图片的根目录
    'VIEW_ROOT_PATH'       => '/Public/Uploads/',
);