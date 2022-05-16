<?php

//定义项目目录
const APP_PATH = __DIR__.'/';
//导入核心加载类
require (APP_PATH.'core/Load.php');
//加载核心类
(new core\Load())->run();

