<?php
/**
 * Created by PhpStorm.
 * User: lify
 * Date: 2018/4/11
 * Time: 下午9:15
 */

namespace app\index\controller;

class Test
{
    /**
     * @param $plan_id
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPlanInfo($plan_id)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'http://readooapi.youshu.cc/Wxpay/getPlanInfo', [
            'form_params' => [
                'plan_id' => $plan_id,
            ]
        ]);
        header('content-type:application/json; charset=utf-8');
        exit($response->getBody());
    }

    public function google()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('http://www.google.com');
        header('content-type:text/html; charset=utf-8');
        exit($response->getBody());
    }
    public function baiDu() {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('http://www.baidu.com');
        header('content-type:text/html; charset=utf-8');
        exit($response->getBody());
    }
    public function youshu() {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('http://www.youshu.cc');
        header('content-type:text/html; charset=utf-8');
        exit($response->getBody());
    }
}