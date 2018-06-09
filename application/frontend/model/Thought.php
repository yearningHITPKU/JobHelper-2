<?php

namespace app\frontend\model;

use think\Db;
use think\Model;

class Thought extends Model
{
    protected $pk = 'id';
    protected $table = 'thoughts';

    public function getThought($thought_type)
    {
        $res = $this->where('type', $thought_type)
            ->order('time_publish desc')
            ->paginate(15);
        return $res;
    }
    public function getDetail($id,$user_id)
    {
        $this->where('id', $id)->setInc('click_times', 1);
        //$res1 = $this->where('id',$id)->find();
        $res1 = $this->alias('t')
            ->join('__USER__ u', 't.owner_id=u.id')
            ->where('t.id', $id)
            ->field('t.*, u.name as owner_name')
            ->find();
        $res2 = Db::name('collection')
            ->alias('c')
            ->join('__USER__ u', 'c.user_id=u.id')
            ->where('u.uid',$user_id)
            ->where('c.target_id',$id)
            ->where('c.target_type',1)
            ->select();
        $isCollected = false;
        if(sizeof($res2) == 0){
            $isCollected = false;
        }else{
            $isCollected = true;
        }

        $res['data'] = $res1;
        $res['isCollected'] = $isCollected;
        return $res;
    }

    public function getAll()
    {
        $res = Db::name('thoughts')
            ->order('time_publish desc')
            ->field('id,title,time_publish')
            ->select();
        return $res;
    }

    public function getUserThought($user_id)
    {
        $res = $this->alias('t')
            ->join('user u','t.owner_id=u.id')
            ->where('u.uid', $user_id)
            ->order('t.time_publish desc')
            ->field('t.id,t.title,t.corp_name,t.position,t.time_publish')
            ->select();
        return $res;
    }

    public function getSearch($search)
    {
        $res = $this->alias('t')
            ->join('user u','t.owner_id=u.id')
            ->where(['t.title|t.corp_name|t.position|t.detail|u.uid|u.name'=>['like',"%".$search."%"]])
            ->order('t.time_publish desc')
            ->field('t.id,t.title,t.corp_name,t.position,t.time_publish')
            ->select();
        return $res;
    }
}
