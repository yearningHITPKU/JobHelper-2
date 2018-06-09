<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use think\Log;
use PHPExcel_IOFactory;     //导出excel所需的引用，位于vendor目录
use PHPExcel_Style_Color;
use PHPExcel_Style_Alignment;

class Thought extends Base
{
    public function index()
    {
        $this->isLogin();
        $thoughtModel = new \app\admin\model\Thought();

        $thoughts = $thoughtModel->alias('t')
            ->join('user u','u.id=t.owner_id')
            ->order('t.time_publish desc')
            ->field('t.*,u.name, u.uid')
            ->paginate(10);

        //2.将数据赋值给模板
        $this->view->assign('thought_list', $thoughts);
        $this->view->assign('thought_size', count($thoughts));
        //3.分页器对象传给前端，显示页码
        $page = $thoughts->render();
        $this->view->assign('page', $page);
        //4.渲染模板
        return $this->view->fetch('thought_list');
    }

    public function delete(Request $request)
    {
        $this->isLogin();
        if($request->isAjax(true)){
            //获取请求数据，自动过滤空值
            $data = array_filter($request->param());
            //设置删除条件
            $map = ['id' => $data['id']];
            //更新intern表中的数据
            $result = \app\admin\model\Thought::destroy($map);

            //更新成功的提示信息
            $status = 1;
            $message = '删除成功';
            //更新失败
            if(is_null($result)){
                $status = 0;
                $message = '删除失败';
            }
        }

        return ['status'=>$status, 'message'=>$message];
    }

    public function deleteSelected(Request $request)
    {
        $this->isLogin();
        if($request->isAjax(true)){
            //获取请求数据，自动过滤空值
            $data = array_filter($request->param());
            //填写日志
            Log::record('-------------------------deleteSelected-------------------------');
            Log::record($data);
            //解析ajax发送的数据
            $dejson = json_decode($data['json']);
            Log::record($dejson);
            //实例化模型
            $thought = new \app\admin\model\Thought();
            //设置删除条件
            $list = array();
            for($i = 0; $i < count($dejson); $i++){
                $list[$i] = $dejson[$i];
            }
            Log::record($list);
            //批量删除表中数据
            $result = $thought::destroy($list);
            //更新成功的提示信息
            $status = 1;
            $message = '删除成功';
            //更新失败
            if(is_null($result)){
                $status = 0;
                $message = '删除失败';
            }
        }

        return ['status'=>$status, 'message'=>$message];

    }

    public function save(Request $request)
    {
        //判断是否管理员操作
        if(session('user_id')!='admin'){
            return '未登录或登录已超时，请重新登录再导出';
        }

        //判断下载全部还是下载部分实习信息，并从数据库取得相应数据
        $id = $request->param()['id'];
        if($id==-1){     //下载全部
            //$data = model('Thought')->order('time_publish desc')->select();
            $thoughtModel = new \app\admin\model\Thought();
            $data = $thoughtModel->alias('t')
                ->join('user u','u.id=t.owner_id')
                ->order('t.time_publish desc')
                ->field('t.*,u.name, u.uid')
                ->select();
        }elseif($id == '-'){ //没选中的时候点下载选中
            $this->error('未选中欲下载的条目','thought/index','',2);
        }else{//下载选中
            $ids = explode('-',$id);
            //$data = \app\admin\model\Thought::all($ids);
            $thoughtModel = new \app\admin\model\Thought();
            $res = $thoughtModel->alias('t')
                ->join('user u','u.id=t.owner_id')
                ->order('t.time_publish desc')
                ->field('t.*,u.name, u.uid')
                ->select();
            $data = [];
            foreach ($res as $key=>$thought) {
                if($thought['id']){

                }

            }
        }

        /*
         * 下载PHPExcel，将classes文件放进根目录的vendor目录。
         * 然后引入PHPExcel所需文件
         */
        vendor("PHPExcel.PHPExcel.Writer.IWriter");
        vendor("PHPExcel.PHPExcel.Writer.Abstract");
        vendor("PHPExcel.PHPExcel.PHPExcel");
        vendor("PHPExcel.PHPExcel.Writer.Excel2007");
        vendor("PHPExcel.PHPExcel.IOFactory");
        vendor("PHPExcel.PHPExcel.Style.Alignment");
        vendor("PHPExcel.PHPExcel.Style.Font");

        /*
         * 建立excel文件，新建sheet，写出表头；
         */
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1','序号')
            ->setCellValue('B1','ID')
            ->setCellValue('C1','标题')
            ->setCellValue('D1','发布人学号')
            ->setCellValue('E1','发布人姓名')
            ->setCellValue('F1','公司')
            ->setCellValue('G1','岗位')
            ->setCellValue('H1','发布时间')
        ;
        //设置sheet的名称
        $objPHPExcel->getActiveSheet()->setTitle('面试经验');
        $objPHPExcel->getActiveSheet()->getColumnDimension(\PHPExcel_Cell::stringFromColumnIndex(0))->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension(\PHPExcel_Cell::stringFromColumnIndex(1))->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension(\PHPExcel_Cell::stringFromColumnIndex(2))->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension(\PHPExcel_Cell::stringFromColumnIndex(3))->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension(\PHPExcel_Cell::stringFromColumnIndex(4))->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension(\PHPExcel_Cell::stringFromColumnIndex(5))->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension(\PHPExcel_Cell::stringFromColumnIndex(6))->setWidth(12);
        $objPHPExcel->getActiveSheet()->getColumnDimension(\PHPExcel_Cell::stringFromColumnIndex(7))->setWidth(20);

        //循环遍历每条数据
        $letter = array('A','B','C','D','E','F','G','H','I','J','K','L');
        foreach ($data as $key=>$thought){
            $row = $key+2;
            //循环遍历每条数据的每一列
            //$this_user = \app\admin\model\User::get($intern->owner_id);
            for ($column = 0;$column<count($letter);$column++){
                //写出长整数时，为避免被科学计数法表示，在前面加空格，用.连接
                if($column ==1){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $thought->id);
                }elseif ($column ==2){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $thought->title);
                }elseif ($column ==3){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $thought->uid);
                }elseif ($column ==4){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $thought->name);
                }elseif ($column ==5){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $thought->corp_name);
                }elseif ($column ==6){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $thought->position);
                }elseif ($column ==7){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $thought->time_publish);
                }elseif ($column ==0){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $row-1);
                }
            }
        }

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);        //设置固定行高

        for ($i=0;$i<count($letter);$i++){                                              //设置表头粗体和颜色
            $objPHPExcel->getActiveSheet()->getStyle($letter[$i].'1')->getFont()->setBold(true);
            //第一次需要先new一下，后面不需要
            $objPHPExcel->getActiveSheet()->getStyle($letter[$i].'1')->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_DARKGREEN ));
        }

        //输出文件
        $filename = date("Y-m-d H:i:s").'.xlsx';  //输出的excel文档名称
        ob_end_clean();     //清空缓冲区避免乱码
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');//告诉浏览器数据excel07文件
        header('Content-Disposition: attachment;filename="'.$filename.'"');//告诉浏览器将输出文件的名称
        header('Cache-Control: max-age=0');//禁止缓存
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //不写这句导出的excel会被提示有错误需要修复
        exit;

    }
}
