<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/27
 * Time: 下午5:57
 */
namespace app\common\model;
use think\Model;

class Base extends Model {

    protected  $autoWriteTimestamp = true;

    /**
     * [addData  通用新增数据]
     * @author [忘尘]
     * @param $data
     * @return int
     */
    public function addData($data) {
        if(!is_array($data)) {
            exception('传递数据不合法');
        }

        $this->allowField(true)->isUpdate(false)->save($data);

        return $this->id;
    }

    /**
     * [findData  根据id获取信息]
     * @author [忘尘]
     * @param string $id
     * @return array
     */
    public function findData($id = '')
    {
        if(empty($id))
            exception('传递数据不合法');

        return  $this->where('id', $id)->find();
    }


    /**
     * [getAllData  获取全部数据]
     * @author [忘尘]
     * @return array
     */
    public function getAllData($map=[])
    {
        return $this->order(['id' => 'desc'])->where($map)->select();
    }


    /**
     * [editData  通用更新数据]
     * @author [忘尘]
     * @param $data
     * @return mixed
     */
    public function editData($data)
    {
        if(!is_array($data))
            exception('传递数据不合法');

        $this->allowField(true)->isUpdate(true)->save($data, ['id' => $data['id']]);

        return $this->id;
    }

    /**
     * [deleteTrueData  真正删除数据]
     * @author [忘尘]
     * @param string $id
     * @return bool
     */
    public function deleteTrueData($id = '')
    {
        if(empty($id))
            exception('传递数据不合法');

        $res = $this->where('id','=',$id)->delete();

        if($res)
            return true;
        else
            return false;
    }

    /**
     * [deleteFalseData  假删除数据]
     * @author [忘尘]
     * @param array
     */
    public function deleteFalseData($where,$data)
    {
        if(!is_array($where) && $data)
            exception('传递数据不合法');

        return $this->allowField(true)->isUpdate(true)->save($data, $where);
    }


    /**
     * [changeStatus  修改状态值]
     * @author [忘尘]
     * @param $where
     * @param int $status 修改的值
     * @return false|int
     */
    public function changeStatus($where,$status=0)
    {
        if(!is_array($where))
            exception('传递数据不合法');

        return $this->allowField(true)->isUpdate(true)->save(['status'=>$status], $where);
    }



    /**
     * 根据搜索条件获取所有的用户数量
     * @param $where
     */
    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }

}