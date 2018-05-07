<?php
/**
 * Created by PhpStorm.
 * User: lify
 * Date: 2018/4/12
 * Time: 下午6:10
 */

namespace app\index\controller;

use EasyWeChat\Factory;

class WeChatServer
{

    /**
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function valid()
    {
        $config = [
            'app_id' => 'wx14c234c622a85b21',
            'secret' => '7a7cb78c2d86044fad4de7192bacd1aa',
            'response_type' => 'array',
            'log' => [
                'level' => 'debug',
                'file' => RUNTIME_PATH . 'log/wechat.log',
            ],
        ];

        $app = Factory::officialAccount($config);

        $response = $app->server->serve();

        // 将响应输出
        $response->send();
    }
}