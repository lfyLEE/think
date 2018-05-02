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
            'base_uri' => 'http://www.readwith.com',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
        $result = $client->request('GET', '/Test/test');
        dump($result);
    }
}