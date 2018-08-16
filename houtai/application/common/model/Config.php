<?php

namespace app\common\model;
use think\Model;

class Config extends Model
{
    protected $name = 'config';

    //获取配置所有信息
    public function getAllConfig()
    {
        return $this->select();
    }


    //保存信息
    public function SaveConfig($map,$value)
    {
        try{
            $result = $this->allowField(true)->where($map)->setField('value', $value);
            if(false === $result){            
                return ['code' => -1, 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'msg' => '保存成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

}