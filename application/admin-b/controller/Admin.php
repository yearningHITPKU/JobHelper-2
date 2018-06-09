<?php

namespace app\admin\controller;
use app\admin\common\Base;
use app\admin\model\Super;
use think\exception\DbException;
use think\Request;
use think\Session;

class Admin extends Base
{
    public function index()
    {
        //1.读取super表数据‘
        $admin = Super::get(['username'=>'admin']);
        //2.将当前管理员信赋值给模板
        $this->view->assign('admin', $admin);
        //3.渲染模板
        return $this->view->fetch('admin_list');
    }

    public function edit()
    {

        return $this->view->fetch('admin_edit');
    }

    public function update(Request $request){

        try {
            $admin = Super::get(1);
            if (Session::get('user_id') == $admin->username) {
                $admin->password = $request->param()['password'];
                $admin->save();
                $message = '修改成功';
                $status = 1;
            } else {
                $message = '非法操作';
                $status = 0;
            }
        } catch (DbException $e) {
            $message = '数据库错误，请稍后重试';
            $status = 0;
        }
        return ['status'=>$status,'message'=>$message];
    }

}
