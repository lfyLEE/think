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

class WeChatServer
{

    /**
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function run()
    {
        Log::write(json_encode($_GET), 'debug');
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
        $app->server->push(function ($message) {
            switch ($message['MsgType']) {
                case 'event':
                    return '收到事件消息';
                    break;
                case 'text':
                    return '收到文字消息';
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    return '收到语音消息';
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                case 'file':
                    return '收到文件消息';
                    break;
                default:
                    return '收到其它消息';
                    break;
            }
        });
        $response = $app->server->serve();

        // 将响应输出
        $response->send();
    }
}