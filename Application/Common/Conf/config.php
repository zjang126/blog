<?php
return array(
    //'配置项'=>'配置值'
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'bobo',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '111111',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  '',    // 数据库表前缀

    'DEFAULT_MODULE'        =>  'Admin',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'Login', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'login', // 默认操作名称

    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'TMPL_PARSE_STRING'  =>array(
        'ADMIN_PUBLIC' => '/Public/Admin',
        "VIEW_UPLOAD" => "/Public/Uploads",
    ) ,
    'TMPL_L_DELIM' => '{{', // 模板引擎普通标签开始标记
    'TMPL_R_DELIM' => '}}', // 模板引擎普通标签结束标记
    'URL_PARAMS_BIND'       =>  true, // URL变量绑定到操作方法作为参数
//    开启页面trace调试
    'SHOW_PAGE_TRACE'=>true,
    // 关闭字段缓存
    'DB_FIELDS_CACHE'=>false,
    //入口文件到文件夹的地址
    "UPLOAD_PATH" => "./Public/Uploads/",
);