<?php
/**
 * Created by PhpStorm.
 * User: THINK
 * Date: 2018/4/8
 * Time: 14:58
 */
namespace app\admin\common;
use think\Controller;
use think\Cookie;
use think\Session;

class Base extends Controller
{
    public $isLoginJump = false;

    protected function _initialize()
    {
        parent::_initialize();
        define('USER_ID', Session::get('user_id'));
        if($this->isLoginJump){
            $isLoginJump = false;
        }
    }

    protected function isLogin(){
        if (is_null(USER_ID) || is_null(Cookie::get('adm_info'))){
            $isLoginJump = true;
            $this -> error('未登录', 'login/index');
        }
    }

    protected function alreadyLogin(){
        if (!is_null(USER_ID) && !is_null(Cookie::get('adm_info'))){
            $this->error('已经登录，无需再登','index/index');
        }
    }

}