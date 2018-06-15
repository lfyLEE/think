<?php
/**
 * Created by PhpStorm.
 * User: lify
 * Date: 2018/5/9
 * Time: 下午1:16
 */

namespace app\service;
use EasyWeChat\Factory;

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
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function test(): string
    {
        return 'hello';
    }

    /**
     * @param $message {"ToUserName":"gh_d0c8db9ba4bc","FromUserName":"o4nBjwWvi2gM2wnk7kRMqkgha3c0","CreateTime":"1525870101","MsgType":"text","Content":"a","MsgId":"6553562182312353424"} toArray
     * @return string
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function eventResponse($message): string
    {
        switch ($message['MsgType']) {
            case 'event':
                $message['event'] = strtolower($message['event']);
                switch ($message['event']) {
                //关注
                    case 'subscribe':
                        //二维码关注
                        if(isset($request['eventkey']) && isset($request['ticket'])){
                            $data = '二维码关注';
                            //普通关注
                        }else{
                            $data = '普通关注';
                        }
                        break;
                    //扫描二维码(已关注)
                    case 'scan':
                        $data = '扫码二维码';
                        break;
                    //地理位置
                    case 'location':
                        $data = '地理位置';
                        break;
                    //自定义菜单 - 点击菜单拉取消息时的事件推送
                    case 'click':
                        $data = 'click';
                        break;
                    //自定义菜单 - 点击菜单跳转链接时的事件推送
                    case 'view':
                        $data = 'view';
                        break;
                    //自定义菜单 - 扫码推事件的事件推送
                    case 'scancode_push':
                        $data = 'scancode_push';
                        break;
                    //自定义菜单 - 扫码推事件且弹出“消息接收中”提示框的事件推送
                    case 'scancode_waitmsg':
                        $data = 'scancode_waitmsg';
                        break;
                    //自定义菜单 - 弹出系统拍照发图的事件推送
                    case 'pic_sysphoto':
                        $data = 'pic_sysphoto';
                        break;
                    //自定义菜单 - 弹出拍照或者相册发图的事件推送
                    case 'pic_photo_or_album':
                        $data = 'pic_photo_or_album';
                        break;
                    //自定义菜单 - 弹出微信相册发图器的事件推送
                    case 'pic_weixin':
                        $data = 'pic_weixin';
                        break;
                    //自定义菜单 - 弹出地理位置选择器的事件推送
                    case 'location_select':
                        $data = 'location_select';
                        break;
                    //取消关注
                    case 'unsubscribe':
                        $data = 'unsubscribe';
                        break;
                    //群发接口完成后推送的结果
                    case 'masssendjobfinish':
                        $data = 'masssendjobfinish';
                        break;
                    //模板消息完成后推送的结果
                    case 'templatesendjobfinish':
                        $data = 'templatesendjobfinish';
                        break;
                    default:
                        $data = '';
                        break;
                }
                break;
            case 'text':
                $data = json_encode($message);
                if ($message['Content'] == 'template') {
                    $this->send($message['ToUserName'], $message['FromUserName']);
                }
                break;
            case 'image':
                $data = '收到图片消息';
                break;
            case 'voice':
                $data = '收到语音消息';
                break;
            case 'video':
                $data = '收到视频消息';
                break;
            case 'location':
                $data = '收到坐标消息';
                break;
            case 'link':
                $data = '收到链接消息';
                break;
            case 'file':
                $data = '收到文件消息';
                break;
            default:
                $data = '收到其它消息';
                break;
        }
        return $data;
    }

    /**
     * @param $open_id
     * @param $template_id
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     */
    public function send($wechat, $open_id) {
        $wechat_config = \app\common\Config::getWeChatConfig($wechat);
        $config = [
            'app_id' => $wechat_config['appId'],
            'secret' => $wechat_config['appSecret'],
            'response_type' => 'array',
            'log' => [
                'level' => 'debug',
                'file'  => '/webdata/think/runtime/log/', // XXX: 绝对路径！！！！
            ],
        ];

        $app = Factory::officialAccount($config);
        $app->template_message->send([
            'touser' => $open_id,
            'template_id' => $wechat_config['templateId'],
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