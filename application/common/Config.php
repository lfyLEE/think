<?php
/**
 * Created by PhpStorm.
 * User: lify
 * Date: 2018/6/15
 * Time: 下午5:03
 */

namespace app\common;
class Config
{
    public static function getWeChatConfig($wechat)
    {
        $config = parse_ini_file(CONFIG_PATH . '/wechat.ini', true, 1);
        if (!isset($config[$wechat])) return [];
        return $config[$wechat];
    }
}