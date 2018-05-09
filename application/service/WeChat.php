<?php
/**
 * Created by PhpStorm.
 * User: lify
 * Date: 2018/5/9
 * Time: 下午1:16
 */

namespace app\service;


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

    public function eventResponse($message): string
    {
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
    }
}