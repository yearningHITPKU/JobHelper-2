<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Cookie;
use think\Log;
use think\Request;
use app\admin\model\Super;
use think\Session;

class Login extends Base
{

    public function index()
    {
        $this->alreadyLogin();
        return $this->view->fetch('login');
    }


    public function check(Request $request)
    {
        // 设置status
        $status = 0;

        //获取表单数据，保存
        $data = $request->param();
        $userName = $data['username'];
        $password = md5($data['password']);
        if($request->has('isRememberMe')){
            $isRememberMe = $data['isRememberMe'];
        }else{
            $isRememberMe = 'off';
        }
        $captcha = $data['captcha'];

        // 首先判断验证码是否正确
        $isCaptchaRight = $this->validate($data, ['captcha|验证码'=>'require|captcha']);
        Log::record($isCaptchaRight);
        if($isCaptchaRight == 'true'){
            // 在super表中进行查询
            $map = ['username'=>$userName];
            $admin = Super::get($map);

            // 用户名和密码分开验证
            if (is_null($admin)){
                $message = "用户名或密码错误";
            } elseif($admin-> password != $password){
                $message = "用户名或密码错误";
            } else{
                $status =1;
                $message = "登录成功";

                //$admin -> setInc('login_count');
                $admin -> save(['last_time'=> time()]);

                Session::set('user_id', $userName);
                Session::set('user_info', $data);

                //设置cookie有效时间
                if($isRememberMe == 'on'){
                    cookie('adm_info',session('user_info'),60*60*24*7);
                    Log::record('cookie有效时间为：7*24小时');
                }else{
                    cookie('adm_info',session('user_info'),60*60*24*1);
                    Log::record('cookie有效时间为：24小时');
                }
            }
        } else if($isCaptchaRight != 'true'){
            $message = "验证码错误";
        }
        //Log::record(Cookie::get('adm_info'));

        return ['status' => $status,'message' => $message];
    }

    public function logout(){
        Session::delete('user_id');
        Session::delete('user_info');
        Cookie::delete('adm_info');

        Log::record(Cookie::get('adm_info'));
        Log::record(session('user_info'));
        Log::record(session('user_id'));

        $this -> success('注销成功，正在返回', 'login/index');
    }
}
