<?php

namespace app\common\model;

class Article extends Base
{
    /**
     * [getArticleByCondition  根据搜索条件获取用户列表信息]
     * @author [忘尘]
     * @param $map
     * @param $from
     * @param $size
     * @return array
     */
    public function getArticleByCondition($map, $from, $size)
    {
        $orde = ['id' => 'desc'];

        $join = [
            ['think_article_cate cate', 'a.cate_id = cate.id']
        ];

       $lists =  $this->alias('a')
            ->field('a.*,cate.name')
            ->join($join)
            ->where($map)
            ->limit($from, $size)
            ->order($orde)
            ->select();
        return $lists;
    }

    /**
     * [getArticleCountByCondition  根据搜索条件获取满足条数]
     * @author [忘尘]
     * @param $map
     * @return int
     */
    public function getArticleCountByCondition($map)
    {
       return $this->where($map)->count();
    }



    /**
     * [upAndDown  上一篇和下一篇]
     * @author [忘尘]
     * @param int $id
     * @param int $cate_id
     * @return array
     */
    public function upAndDown($id = 0, $cate_id = 0)
    {
        $map['status'] = ['eq', config('home.article_status')];
        $map['cate_id'] = ['eq', $cate_id];
        $order = ['id' => 'asc'];

        $lists = $this->where( $map )->field('id,title')->order($order)->select();

        $up= ['id'=>$id, 'title'=>'没有更多了'];
        $down= ['id'=>$id, 'title'=>'没有更多了'];
        foreach ($lists as $k => $v)
        {
            if($id == $v['id'])
            {
                if($k == 0)
                {
                    if(isset($lists[1]))
                        $down = $lists[1];//当前文章是第一条，下一条$lists[1]
                }
                elseif($k+1 ==count($lists))
                {
                    if(isset($lists[$k-1]))
                        $up = $lists[$k-1];//当前文章是最后条，上一条$lists[$k-1]
                }
                else
                {
                    $up = $lists[$k-1];
                    $down = $lists[$k+1];
                }
                break;
            }
        }
        return [$up, $down];
    }

    /**
     * [addViewsCoumnt  阅读数+1]
     * @author [默默]
     * @param int $id 文章id
     */
    public function addViewsCoumnt($id = 0)
    {
        if(empty($id))
            exception('传递数据不合法');

        return $this->where('id', $id)->setInc('views');
    }

    /**
     * [mostClickArticl  最多点击数]
     * @author [忘尘]
     * @return array
     */
    public function mostClickArticle($limit=10)
    {

        $orde = ['views' => 'desc'];

        $join = [
            ['think_article_cate cate', 'a.cate_id = cate.id']
        ];

        $map = ['a.status' => 1];

        $lists =  $this->alias('a')
            ->field('a.*,cate.name')
            ->join($join)
            ->where($map)
            ->limit($limit)
            ->order($orde)
            ->select();

        return $lists;
    }

    /**
     * [_randomArticle  随机文章]
     * @author [忘尘]
     */
    public function randomArticle($limit=5)
    {
        $orde = ['id' => 'desc'];
        $join = [
            ['think_article_cate cate', 'a.cate_id = cate.id']
        ];
        $map = ['a.status' => 1];

        $lists =  $this->alias('a')
            ->field('a.*,cate.name')
            ->join($join)
            ->where($map)
            ->order($orde)
            ->select();
        $random_keys=array_rand($lists,$limit);
        $randomArticle = [];

        for($i=0;$i<$limit;$i++)
        {
            $randomArticle[] = $lists[$random_keys[$i]];
        }
        return $randomArticle;
    }


    /**
     * [getTag  我的标签]
     * @author [忘尘]
     * @return array
     */
    public function getTag()
    {
        $map = ['status' => 1,'keyword'=>['neq','']];
        $res =  $this->field('id,keyword') ->where($map)->select();
        return $res;
    }

}