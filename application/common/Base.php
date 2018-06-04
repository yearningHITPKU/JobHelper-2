<?php

namespace app\common;

use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
        parent::_initialize();

        if(!session('user_id')) {

            //获得加密的rawdata
            $getdata = input('get.');
            if(!$getdata || !isset($getdata['rawdata'])) {
                $this->error("请通过微信校园卡登录");
            } else {
                $rawdata = $getdata['rawdata'];
                $this->redirect('front/login/login',['rawdata' => $rawdata]);
            }
        }
    }
}
