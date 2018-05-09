<?php
/**
 * Created by PhpStorm.
 * User: lify
 * Date: 2018/5/9
 * Time: 下午1:16
 */

namespace app\service;
use EasyWeChat\Factory;
use think\Log;

class WeChat
{
    public static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance(): WeChat
    {
        if (self::$instance instanceof self) {
            return self::$instance;
        }
        return new self();
    }

    public static function test(): string
    {
        return 'hello 世界';
    }

    /**
     * @param $message
     * @return string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function eventResponse($message): string
    {
        switch ($message['MsgType']) {
            case 'event':
                return '收到事件消息';
                break;
            case 'text':
                $this->send($message['FromUserName'], 'wV9TgcdC10jTy5LwfvybqHPitsu4NQVuUbRk7jyyPaA');
                //return '收到文字消息';
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
    }

    /**
     * @param $open_id
     * @param $template_id
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function send($open_id, $template_id) {
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
        $app->template_message->send([
            'touser' => $open_id,
            'template_id' => $template_id,
            'url' => 'http://www.biubiupiu.site',
            'data' => [
                'first' => ['你好', '#F00'],
                'keyword1' => 'biu',
                'keyword2' => 'biu',
                'keyword3' => 'piu',
            ],
        ]);
    }
}