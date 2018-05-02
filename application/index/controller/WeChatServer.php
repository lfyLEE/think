<?php
/**
 * Created by PhpStorm.
 * User: lify
 * Date: 2018/4/12
 * Time: 下午6:10
 */

namespace app\index\controller;

use GuzzleHttp\Client;

class WeChatServer
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function valid()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://readooapi.youshu.cc',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
        $result = $client->request('GET', '/Wxpay/getPlanInfo?plan_id=66');
        dump($result);
    }
}