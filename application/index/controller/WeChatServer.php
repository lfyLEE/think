<?php
/**
 * Created by PhpStorm.
 * User: lify
 * Date: 2018/4/12
 * Time: 下午6:10
 */

namespace app\index\controller;

use EasyWeChat\Factory;
use think\log;
use think\Request;
use app\service\WeChat;
use app\common\Config;

class WeChatServer
{

    /**
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function run()
    {
        Log::write(file_get_contents('php://input'), 'debug');
        $wechat = Request::instance()->get('wechat');
        if (!$wechat) exit('success');
        $wechat_config = Config::getWeChatConfig($wechat);
        if (!$wechat_config) exit('success');
        $config = [
            'app_id' => $wechat_config['appId'],
            'secret' => $wechat_config['appSecret'],
            'response_type' => 'array',
            /*'log' => [
                'level' => 'debug',
                'file' => RUNTIME_PATH . 'log/wechat.log',
            ],*/
        ];

        $app = Factory::officialAccount($config);
        $app->server->push(function ($message) {
            return WeChat::getInstance()->eventResponse($message);
        });
        $response = $app->server->serve();

        // 将响应输出
        $response->send();
    }
}