<?php
/**
 * Created by PhpStorm.
 * User: lify
 * Date: 2018/4/11
 * Time: 下午9:15
 */

namespace app\index\controller;
use app\service\WeChat;

class Test
{
    public function testConfig() {
        $data = parse_ini_file(ROOT_PATH . '/config.ini', true, 1);
        dump($data);
    }
}