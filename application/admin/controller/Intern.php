<?php

namespace app\admin\controller;

use app\admin\common\Base;
use app\user\model\Interns;
use think\Log;
use think\Request;
use PHPExcel_IOFactory;     //导出excel所需的引用，位于vendor目录
use PHPExcel_Style_Color;
use PHPExcel_Style_Alignment;

class Intern extends Base
{
    public function index()
    {
        $this->isLogin();
        //1.从数据库中读取所有is_allowed字段为1的数据，并且分页，参数为每页的条数
        $internModel = new \app\admin\model\Intern();

        //$interns = $internModel->where('is_allowed',1)->order('')->paginate(10);
        $interns = $internModel->alias('i')
            ->join('user u','i.owner_id=u.id')
            ->where('i.is_allowed',1)
            ->order('i.time_publish desc')
            ->field('i.*, u.name, u.uid')
            ->paginate(10);

        //2.将数据赋值给模板
        $this->view->assign('intern_list', $interns);
        $this->view->assign('intern_size', count($interns));
        //3.分页器对象传给前端，显示页码
        $page = $interns->render();
        $this->view->assign('page', $page);
        //4.渲染模板
        return $this->view->fetch('check_list');
    }

    public function deleted_list()
    {
        $this->isLogin();
        //1.从数据库中读取所有is_allowed字段为0的数据
        $internModel = new \app\admin\model\Intern();
        //$interns = $internModel->where('is_allowed',0)->paginate(10);
        $interns = $internModel->alias('i')
            ->join('user u','i.owner_id=u.id')
            ->where('i.is_allowed',0)
            ->order('i.time_publish desc')
            ->field('i.*, u.name, u.uid')
            ->paginate(10);
        //2.将数据赋值给模板
        $this->view->assign('intern_list', $interns);
        $this->view->assign('intern_size', count($interns));
        //3.分页器对象传给前端，显示页码
        $page = $interns->render();
        $this->view->assign('page', $page);
        //4.渲染模板
        return $this->view->fetch('deleted_list');
    }

    /**
     * @param Request $request
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 后台导出实习信息功能的实现
     */
    public function save(Request $request)
    {
        //判断是否管理员操作
        if(session('user_id')!='admin'){
            return '未登录或登录已超时，请重新登录再导出';
        }

        //判断下载全部还是下载部分实习信息，并从数据库取得相应数据
        $id = $request->param()['id'];
        if($id==-1){     //下载全部
            $data = model('Intern')->order('time_publish desc')->select();
        }elseif($id == '-'){ //没选中的时候点下载选中
            $this->error('未选中欲下载的条目','intern/index','',2);
        }else{//下载选中
            $ids = explode('-',$id);
            $data = \app\admin\model\Intern::all($ids);
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
            ->setCellValue('D1','公司')
            ->setCellValue('E1','岗位')
            ->setCellValue('F1','地点')
            ->setCellValue('G1','offer种类')
            ->setCellValue('H1','详情')
            ->setCellValue('I1','发布学号')
            ->setCellValue('J1','审核状态')
            ->setCellValue('K1','是否置顶')
            ->setCellValue('L1','发布时间')
        ;
        //设置sheet的名称
        $objPHPExcel->getActiveSheet()->setTitle('实习内推信息');

        //循环遍历每条数据
        $letter = array('A','B','C','D','E','F','G','H','I','J','K','L');
        foreach ($data as $key=>$intern){
            $row = $key+2;
            //循环遍历每条数据的每一列
            $this_user = \app\admin\model\User::get($intern->owner_id);
            for ($column = 0;$column<count($letter);$column++){
                //写出长整数时，为避免被科学计数法表示，在前面加空格，用.连接
                if($column ==1){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $intern->id);
                }elseif ($column ==2){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $intern->title);
                }elseif ($column ==3){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $intern->corp_name);
                }elseif ($column ==4){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $intern->position);
                }elseif ($column ==5){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $intern->location);
                }elseif ($column ==6){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $intern->type);
                }elseif ($column ==7){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $intern->detail);
                }elseif ($column ==8){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", ' '.$this_user->uid);
                }elseif ($column ==9){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $intern->is_allowed);
                }elseif ($column ==10){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $intern->is_pinned);
                }elseif ($column ==11) {
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $intern->time_publish);
                }elseif ($column ==0){
                    $objPHPExcel->getActiveSheet()->setCellValue("$letter[$column]$row", $row-1);
                }
            }
        }

        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);   //设置自动宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);         //设置固定宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);        //设置固定行高

        for ($i=0;$i<count($letter);$i++){                                              //设置表头粗体和颜色
            $objPHPExcel->getActiveSheet()->getStyle($letter[$i].'1')->getFont()->setBold(true);
            //第一次需要先new一下，后面不需要
            $objPHPExcel->getActiveSheet()->getStyle($letter[$i].'1')->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_DARKGREEN ));
        }

        $objPHPExcel->getActiveSheet()->mergeCells('O5:S14');    //合并单元格
        //设置竖直方向对齐方式
        $objPHPExcel->getActiveSheet()->getStyle('O5')->getAlignment()->setVertical(PHPExcel_style_Alignment::VERTICAL_TOP);
        //设置自动换行
        $objPHPExcel->getActiveSheet()->getStyle('O5')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->setCellValue('O5','offer种类列说明：0仅实习 1仅正式录用 2实习然后录用；');

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
    /**
     * 将选定的一条实习内推信息添加到已删除列表
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
        $this->isLogin();
        if($request->isAjax(true)){
            //获取请求数据，自动过滤空值
            $data = array_filter($request->param());

            $intern = new \app\admin\model\Intern;
            // save方法第二个参数为更新条件
            $result = $intern->save([
                'is_allowed'  => '0',
            ],['id' => $data['id']]);

            // save方法第二个参数为更新条件
            $result = $intern->save(
                ['is_allowed'  => '0'],
                ['id' => $data['id']]
            );

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

    //置顶
    public function stick(Request $request)
    {
        $this->isLogin();
        if ($request->isAjax(true)) {
            //获取请求数据，自动过滤空值
            $data = array_filter($request->param());

            $intern = new \app\admin\model\Intern;

            // save方法第二个参数为更新条件
            $result = $intern->save(
                ['is_pinned' => '1'],
                ['id' => $data['id']]
            );

            //更新成功的提示信息
            $status = 1;
            $message = '置顶成功';
            //更新失败
            if (is_null($result)) {
                $status = 0;
                $message = '置顶失败';
            }
        }
        return ['status'=>$status, 'message'=>$message];
    }

    public function stick_cancel(Request $request){
        $this->isLogin();
        if($request->isAjax(true)){
            //获取请求数据，自动过滤空值
            $data = array_filter($request->param());

            $intern = new \app\admin\model\Intern;

            // save方法第二个参数为更新条件
            $result = $intern->save(
                ['is_pinned' => '0'],
                ['id' => $data['id']]
            );

            //更新成功的提示信息
            $status = 1;
            $message = '取消成功';
            //更新失败
            if(is_null($result)){
                $status = 0;
                $message = '取消失败';
            }
        }

            return ['status'=>$status, 'message'=>$message];
    }

    /**
     * 将所有选定实习内推信息添加到已删除列表
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function updateSelected(Request $request)
    {
        $this->isLogin();
        if($request->isAjax(true)){
            //获取请求数据，自动过滤空值
            $data = array_filter($request->param());
            //填写日志
            Log::record($data);
            //解析ajax发送的数据
            $dejson = json_decode($data['json']);
            Log::record($dejson);
            //实例化模型
            $intern = new \app\admin\model\Intern;
            //构建用于更新数据库的条件数组
            $list = array();
            for($i = 0; $i < count($dejson); $i++){
                $list[$i] = ['id'=>$dejson[$i], 'is_allowed'=>0];
            }
            Log::record($list);
            //批量更新表中数据
            $result = $intern->saveAll($list);
            //更新成功的提示信息
            $status = 1;
            $message = '更新成功';
            //更新失败
            if(is_null($result)){
                $status = 0;
                $message = '更新失败';
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
            $intern = new \app\admin\model\Intern;
            //设置删除条件
            $list = array();
            for($i = 0; $i < count($dejson); $i++){
                $list[$i] = $dejson[$i];
            }
            Log::record($list);
            //批量删除表中数据
            $result = \app\admin\model\Intern::destroy($list);
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

    public function recoverSelected(Request $request)
    {
        $this->isLogin();
        if($request->isAjax(true)){
            //获取请求数据，自动过滤空值
            $data = array_filter($request->param());
            //填写日志
            Log::record($data);
            //解析ajax发送的数据
            $dejson = json_decode($data['json']);
            Log::record($dejson);
            //实例化模型
            $intern = new \app\admin\model\Intern;
            //构建用于更新数据库的条件数组
            $list = array();
            for($i = 0; $i < count($dejson); $i++){
                $list[$i] = ['id'=>$dejson[$i], 'is_allowed'=>1];
            }
            Log::record($list);
            //批量更新表中数据
            $result = $intern->saveAll($list);
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


    /**
     * 恢复选定的一条实习内推信息
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function recover(Request $request)
    {
        $this->isLogin();
        if($request->isAjax(true)){
            //获取请求数据，自动过滤空值
            $data = array_filter($request->param());

            $intern = new \app\admin\model\Intern;
            // save方法第二个参数为更新条件
            $result = $intern->save([
                'is_allowed'  => '1',
            ],['id' => $data['id']]);

            //更新成功的提示信息
            $status = 1;
            $message = '恢复成功';
            //更新失败
            if(is_null($result)){
                $status = 0;
                $message = '恢复失败';
            }
        }

        return ['status'=>$status, 'message'=>$message];
    }

    /**
     * 删除选定的一条实习内推信息
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete(Request $request)
    {
        $this->isLogin();
        if($request->isAjax(true)){
            //获取请求数据，自动过滤空值
            $data = array_filter($request->param());
            //设置删除条件
            $map = ['id' => $data['id']];
            //更新intern表中的数据
            $result = \app\admin\model\Intern::destroy($map);

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
}
